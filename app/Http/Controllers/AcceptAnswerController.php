<?php

namespace App\Http\Controllers;

use App\Answer;
use Illuminate\Http\Request;

class AcceptAnswerController extends Controller
{
    public function __invoke(Answer $answer)
    {
        // $answer->question->best_answer_id=$answer->id;
        // $answer->question->save();
        //  instead of this lets define a fun in model to do so
        $this->authorize('acceptBestAnswer',$answer);
        $answer->question->acceptBestAnswer($answer);
        return back()->with('Success','Marked as best answer');
    }
}
