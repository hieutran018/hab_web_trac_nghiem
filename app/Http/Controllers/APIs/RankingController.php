<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ranking;
use DB;
use Image;


class RankingController extends Controller
{
    public function getListRankingChallenge(){
        $ranking_challenge = Ranking::orderBy('score_challenge', 'DESC')->get();
        foreach($ranking_challenge as $rank){
            $rank->user_id = $rank->user->id;
            $rank->user->avatar = asset('storage/account/'.$rank->user->id.'/avatar/'. $rank->user->avatar);
        }


        
        return response()->json($ranking_challenge,200);
    }
    public function getListRankingSingle(){
        $ranking_single = Ranking::orderBy('score_single', 'DESC')->get();
        foreach($ranking_single as $rank){
            $rank->user_id = $rank->user->id;
            $rank->user->avatar = $rank->user->avatar = asset('storage/account/'.$rank->user->id.'/avatar/'. $rank->user->avatar);
        }
        
        // dd($ranking_single);
        return response()->json($ranking_single,200);
    }
}