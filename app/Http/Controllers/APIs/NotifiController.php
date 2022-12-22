<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notify;
use App\Models\User;
use App\Models\MatchHistory;

class NotifiController extends Controller
{
    public function getListNotifi(Request $request){
        $lst = Notify::WHERE('user_id_confirm',$request->user()->id)->get();
        foreach($lst as $l){
            $l->user_id_request = USER::WHERE('id', $l->user_id_request)->get('display_name');
            $l->user_id_confirm = USER::WHERE('id', $l->user_id_confirm)->get('display_name');
            $l->level_id = MatchHistory::WHERE('id',$l->match_id)->select('level_id AS id')->get();
            $l->topic_id = MatchHistory::WHERE('id',$l->match_id)->select('topic_question_id AS id')->get();
        }
        
        return response()->json($lst,200);
    }
}