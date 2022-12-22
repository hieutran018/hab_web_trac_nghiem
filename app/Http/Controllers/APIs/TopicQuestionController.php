<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TopicQuestion;

class TopicQuestionController extends Controller
{
    public function getTopicQuestion(){
        $tpq = TopicQuestion::all();
        foreach($tpq as $tp){
            $tp->image = asset('storage/topic_question/'.$tp->image);
        }
        return response()->json($tpq,200);
    }
    public function getTopicById(Request $request){
        $id = $request->id_topic;

        $tp = TopicQuestion::Find($id);
        // $tp->image = asset('storage/topic_question/'.$tp->image);
        return response()->json($tp,200);
    }
}