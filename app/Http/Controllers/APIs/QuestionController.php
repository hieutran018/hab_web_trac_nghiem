<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Level;
use Illuminate\Support\Arr;
use DB;

class QuestionController extends Controller
{
    public function randQuestion(Request $request){
        
        $idTopic = $request->id_topic;
        $idLevel = $request->id_level;
        $level = Level::find($idLevel);
        $lstQuestion = Question::WHERE('topic_id',$idTopic)->WHERE('level_id',$idLevel)->orderBy(DB::raw('RAND()'))->limit($level->amount_question)->get();
        foreach($lstQuestion as $question)
        {
            $question->answer;
        }
        return response()->json($lstQuestion,200);
    }

    public function fetchQuestion(){
        $lst = Question::all();
        foreach($lst as $q)
        {
            $q->answer;
        }
        return response()->json($lst,200);
    }
}