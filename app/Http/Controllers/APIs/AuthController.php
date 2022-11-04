<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Auth;
use Laravel\Sanctum\PersonalAccessToken;
use DB;

class AuthController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request->all(),
            [
                'first_name'=>'required',
                'last_name'=>'required',
                'email' => 'required|email|unique:users',
                'password' => 'required',
                
            ],
            [
                'first_name.required' =>'Họ tên không được bỏ trống!',
                'last_name.required' =>'Tên không được bỏ trống!',
                'email.required' => 'Email không được bỏ trống!',
                'email.email' => 'Email này không hợp lệ!',
                'email.unique' => 'Email này đã được sử dụng ở một tài khoản khác!',
                'password.required' => 'Mật khẩu không được bỏ trống!',
                
            ]);
        if($validator->fails()){
                return response()->json(['message'=>$validator->errors()->toArray()],400);
            }else{
        $data = $request->all();
        // dd($data);
        $acc = new User();
        $acc->first_name = $data['first_name'];
        $acc->last_name = $data['last_name'];
        $acc->email = $data['email'];
        $acc->password =Hash::make($data['password']);
        $acc->status = 1;
        $acc->isAdmin = 0;
        $acc->isSubAdmin = 0;
        $acc->address = null;
        $acc->dateOfBirth = null;
        $acc->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $acc->updated_at = null;
        $acc->save();
        return response()->json(['msg'=>'Successful account registration!'],200);
        }
    }

    public function login(Request $request){
        $validator = Validator::make($request->all(),
            [
                'email' => 'required|email',
                'password' => 'required',
            ],
            [
                'email.required' => 'Email không được bỏ trống!',
                'email.email' => 'Email này không hợp lệ!',
                'password.required' => 'Mật khẩu không được bỏ trống!',
            ]);

            $data = $request->all();
            
            if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password'],'status'=>1,'isAdmin'=>0,'isSubAdmin'=>0])){
                $user = User::where('email', $data['email'])->firstOrFail();
                
                $token = $user->createToken('authToken')->plainTextToken;
            
                return response()->json([
                                        'access_token' => $token,
                                        'token_type' => 'Bearer',],200);
                        
            }
            else{
                return response()->json(['error'=>'Tài khoản này không tồn tại'],400);
            }
                

    }
    public function getUser(Request $request){
        $ranking_single =DB::select('SELECT *,  
        DENSE_RANK() OVER (ORDER BY score_single) dens_rank  
        FROM ranking;');

        $ranking_challenge =DB::select('SELECT *,  
        DENSE_RANK() OVER (ORDER BY score_challenge) dens_rank  
        FROM ranking;');
        foreach($ranking_single as $rank){
            if($rank->user_id == $request->user()->id){
                $ranking_single = $rank->dens_rank;
            }
        }
        foreach($ranking_challenge as $rank){
            if($rank->user_id == $request->user()->id){
                $ranking_challenge = $rank->dens_rank;
            }
        }
        return response()->json(['id'=>$request->user()->id,
                                'first_name'=>$request->user()->first_name,
                                'last_name'=>$request->user()->last_name,
                                'avatar'=>$request->user()->avatar,
                                'email'=>$request->user()->email,
                                'phone'=>$request->user()->phone_number,
                                'address'=>$request->user()->address,
                                'date_of_birth'=>date('d-m-Y', strtotime($request->user()->dateOfBirth)),
                                'life_heart'=>$request->user()->life_heart,
                                'score_single'=>$request->user()->ranking->score_single,
                                'score_challenge'=>$request->user()->ranking->score_challenge,
                                'ranking_single'=>$ranking_single,
                                'ranking_challenge'=>$ranking_challenge
                            ],200);
    }
    public function changePassword(Request $request){
        $data = $request->all();
        $user = $request->user();
        if(empty($user)){
            return response()->json('Có lỗi xảy ra!',400);
        }else{
            if(Hash::check($data['old_password'],$user->password)){
                if($data['new_password']== $data['confirm_new_password']){
                    $update = User::where('id',$user->id)->update(['password'=>Hash::make($data['new_password']),'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh')]);
                }
            }
            else{
                return response()->json('Mật khẩu không khớp!',400);
            }
       return response()->json(['data'=>$data,'user'=>$user],200);
    }
    }


}