<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DB;

class UserController extends Controller
{
    public function updateInfoUser(Request $request){
        $userId = $request->user()->id;

        $user = User::Find($userId);
        if(empty($user)){
            return response()->json(['Không tìm thấy tài khoản trong hệ thống!'],404);
        }else{
            $user->display_name = $request->display_name;
            $user->phone_number = $request->phone_number;
            $user->address = $request->address;
            $date_of_birth = date('y-m-d', strtotime($request->date_of_birth));
            $user->dateOfBirth = $date_of_birth;
            $user->update();
            return response()->json(['message'=>'Cập nhật thông tin thành công!'],200);
        }
    }

    public function getDataUser(Request $request){
        $user = User::Find($request->user_id);
        // $user = User::select('users.id','display_name','avatar','email','phone_number','address','dateOfBirth','life_heart','score_single','score_challenge')
        //                 ->WHERE('users.id',$request->user_id)->join('ranking','ranking.user_id','=','users.id')->get();

        $ranking_single = DB::select('SELECT *,
        DENSE_RANK() OVER (ORDER BY score_single DESC) dens_rank  
        FROM ranking;');

        $ranking_challenge = DB::select('SELECT *,  
        DENSE_RANK() OVER (ORDER BY score_challenge DESC) dens_rank  
        FROM ranking;');
        if(empty($user)){
            return response()->json('Không thể tìm thấy tài khoản này!',404);
        }else{
            $rank_challenge;
            for($i=0;$i<count($ranking_challenge) ; $i++){
                if($ranking_challenge[$i]->user_id == $user->id){
                   $rank_challenge = $ranking_challenge[$i]->dens_rank;
                    break;
                }             
                
            }
            $rank_single;
            for($i=0;$i<count($ranking_single) ; $i++){
                if($ranking_single[$i]->user_id == $user->id){
                   $rank_single = $ranking_single[$i]->dens_rank;
                    break;
                }             
                
            }
            return response()->json(['id'=>$user->id,
                                'display_name'=>$user->display_name,
                                'avatar'=>URL('storage/account/'.$user->id.'/avatar/'.$user->avatar),
                                'email'=>$user->email,
                                'phone'=>$user->phone_number,
                                'address'=>$user->address,
                                'date_of_birth'=>$user->dateOfBirth,
                                'life_heart'=>$user->life_heart,
                                'score_single'=>$user->ranking->score_single,
                                'score_challenge'=>$user->ranking->score_challenge,
                                'ranking_challenge'=>$rank_challenge,
                                'ranking_single'=>$rank_single,
                                ],200);
        }
    }

    public function getlistRandUser(Request $request){
        $lstUser = User::WHERE('id','!=',$request->user()->id)->WHERE('isAdmin',0)->WHERE('isSubAdmin',0)->orderBy(DB::raw('RAND()'))->limit(10)->get();
        foreach($lstUser as $user){
            $user->avatar = URL('storage/account/'.$user->id.'/avatar/'.$user->avatar);
        }
        return response()->json($lstUser,200);
    }
}