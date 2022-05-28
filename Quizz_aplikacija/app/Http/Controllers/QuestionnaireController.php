<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;


class QuestionnaireController extends Controller
{

    public function __construct(){
        $this->middleware('auth');

    }


    public function create(){
        return view('questionnaire.create');
    }

    public function store(){
        $data = request()->validate([
            'title' => "required",
            'purpose' => "required"

        ]);

        $questionnaire = auth()->user()->questionnaires()->create($data);

        return redirect('/questionnaires/'.$questionnaire->id);

    }

    public function show(\App\Models\Questionaire $questionnaire){

        $questionnaire->load('questions.answers.responses');

        return view('questionnaire.show', compact('questionnaire'));

    }

    public function destroy(\App\Models\Questionaire $questionnaire, \App\Models\Question $question,\App\Models\Answer $answer,\App\Models\Survey $survey,
    \App\Models\SurveyResponse $surveyR){


        $questions = $questionnaire->questions;
        foreach($questions as $question){
            $question->answers()->delete();
            $question->delete();
        }
        //$questionnaire->delete();

        $surveys = $questionnaire->surveys;
        foreach($surveys as $survey){
            $survey->responses()->delete();
            $survey->delete();
        }
        $questionnaire->delete();

        return redirect('/home');

    }
}
