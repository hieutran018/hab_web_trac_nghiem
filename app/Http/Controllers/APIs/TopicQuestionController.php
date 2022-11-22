<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TopicQuestion;

class TopicQuestionController extends Controller
{
    public function getTopicQuestion(){
        $tpq = TopicQuestion::WHERE('status',1)->get();
        foreach($tpq as $tp){
            $tp->image = asset('storage/topic_question/'.$tp->image);
        }
        return response()->json($tpq,200);
    }
}