<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use Illuminate\Support\Arr;
use DB;

class QuestionController extends Controller
{
    public function randQuestion($idTopic, $idLevel){
        $lstQuestion = Question::WHERE('topic_id',$idTopic)->WHERE('level_id',$idLevel)->orderBy(DB::raw('RAND()'))->limit(10)->get();
        foreach($lstQuestion as $question)
        {
            $question->answer;
        }
        return response()->json($lstQuestion,200);
    } 
}