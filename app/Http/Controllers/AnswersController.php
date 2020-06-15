<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswersController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Question $question,Request $request)
    {
        // this will return a array with validated data
        // $request->validate(['body'=>'required']);
        // + oprator will merge array
        // $question=Question::find($question);
        $question->answers()->create($request->validate(['body'=>'required'])+['user_id'=>Auth::id()]);
        // dd($question);
        return back()->with('success','Your Answer has been submitted successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question,Answer $answer)
    {
        $this->authorize('update',$answer);
        return view('answers.edit',compact('question','answer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Question $question,Request $request, Answer $answer)
    {
        $this->authorize('update',$answer);
        $answer->update(
            $request->validate(['body'=>'required'])
        );
        return redirect()->route('question.show',$question->slug)->with('success','Answer updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question,Answer $answer)
    {
        $this->authorize('delete',$answer);
        $answer->delete();
        // return redirect()->route('question.show',$question->slug)->with('Deleted','Answer deleted');
        return back()->with('Deleted','Answer has been Removed');
    }
}
