<?php

namespace App\Http\Controllers;

use App\Http\Requests\AskQuestionRequest;
use App\Question;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // DB::enableQueryLog();
        $questions=Question::with('user')->latest()->paginate('5');
        return view('Question.index',compact('questions'));
        //  dd(DB::getQueryLog());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $question=new Question();
        return view('Question.create',compact('question'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AskQuestionRequest $request)
    {
        // $question=new Question();
        // $question->title=$request->title;
        $request->user()->questions()->create($request->all());
        return redirect()->route('Question.index')->with('success','Your Question has been Submitted');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        $question->increment('views');
        return view('Question.show',compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $question=Question::findOrFail($id);
        // if(\Gate::allows('update-question',$question))
        // {
        // return view("Question.edit",compact("question"));
        // }
        // abort(403,"Access Denied");
        $this->authorize('update',$question);
        return view("Question.edit",compact("question"));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(AskQuestionRequest $request,$question)
    {
        $question=Question::findOrFail($question);
        // $request=Question::findOrFail($request);
        // if(\Gate::allows('update-question',$question))
        // {
        //     $question->update($request->only('title','body'));
        //     return redirect()->route('Question.index')->with('success','Updation Success');
        // }
        // abort(403,"Access Denied");
        $this->authorize('update',$question);
        return redirect()->route('Question.index')->with('success','Question Deleted');


    }
    // public function update(AskQuestionRequest $request,Question  $question)
    // {
    //     // dd($question->title);
    //     // $request=Question::findOrFail($request);
    //     // $question->update($request->only('title','body'));
    //     return redirect()->route('Question.index')->with('success','Updation Success');
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy($question)
    {
        $question=Question::findOrFail($question);
        // if(\Gate::allows('delete-question',$question))
        // {
        //     $question->delete();
        //     return redirect()->route('Question.index')->with('success','Question Deleted');
        // }
        // abort(403,"Access Denied");
        //     OR Use Policy Method
        $this->authorize('delete',$question);
        $question->delete();
        return redirect()->route('Question.index')->with('success','Question Deleted');


    }
}
