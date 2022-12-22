<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ranking;

class DashboardController extends Controller
{
    public function getDashboad(){
        return view('admin.pages.dashboard');
    }

    public function getListRankingChallengeDashBoard(){
        $ranking_challenge = Ranking::orderBy('score_challenge', 'DESC')->get();
        foreach($ranking_challenge as $rank){
            $rank->user_id = $rank->user->id;
            $rank->user->avatar = asset('storage/account/'.$rank->user->id.'/avatar/'. $rank->user->avatar);
        }
        return response()->json(['lst'=>$ranking_challenge,'status'=>200]);
    }


}