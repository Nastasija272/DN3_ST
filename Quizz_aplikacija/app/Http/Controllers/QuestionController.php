<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function create(\App\Models\Questionaire $questionnaire){
        return view('question.create',compact('questionnaire'));

    }


    public function store(\App\Models\Questionaire $questionnaire){

        $data = request()->validate([
            'question.question'=>'required',
            'answers.*.answer'=>'required',
        ]);

        $question = $questionnaire->questions()->create($data['question']);
        $question->answers()->createMany($data['answers']);

        return redirect('/questionnaires/'.$questionnaire->id);


    }

    public function destroy(\App\Models\Questionaire $questionnaire, \App\Models\Question $question){

        $question->answers()->delete();
        $question->delete();

        return redirect($questionnaire->path());

    }

}
