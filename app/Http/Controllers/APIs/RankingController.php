<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ranking;
use DB;


class RankingController extends Controller
{
    public function getListRankingChallenge(){
        $ranking_challenge = Ranking::orderBy('score_challenge', 'DESC')->get();
        foreach($ranking_challenge as $rank){
            $rank->user_id = DB::SELECT('SELECT id, first_name, last_name, avatar FROM users WHERE users.id = '.$rank->user_id);

        }


        
        return response()->json($ranking_challenge,200);
    }
    public function getListRankingSingle(){
        $ranking_single = Ranking::orderBy('score_single', 'DESC')->join('users','users.id','=','ranking.id')->get();
        foreach($ranking_single as $rank){
            $rank->user_id = DB::SELECT('SELECT id, first_name, last_name, avatar FROM users WHERE users.id = '.$rank->user_id);

        }
        return response()->json($ranking_single,200);
    }
}