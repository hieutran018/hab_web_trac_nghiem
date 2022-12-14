<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\SocialAccount;
use App\Models\Ranking;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Auth;
use Laravel\Sanctum\PersonalAccessToken;
use DB;
use Illuminate\Support\Facades\Storage;
use Image;

class AuthController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request->all(),
            [
                'display_name'=>'required',
                'email' => 'required|email|unique:users',
                'password' => 'required',
                
            ],
            [
                'display_name.required' =>'Họ tên không được bỏ trống!',
                'email.required' => 'Email không được bỏ trống!',
                'email.email' => 'Email này không hợp lệ!',
                'email.unique' => 'Email này đã được sử dụng ở một tài khoản khác!',
                'password.required' => 'Mật khẩu không được bỏ trống!',
                
            ]);
        if($validator->fails()){
                return response()->json(['error'=>$validator->errors()->toArray()],400);
            }else{
        $data = $request->all();
        // dd($data);
        $acc = new User();
        $acc->display_name = $data['display_name'];
        $acc->email = $data['email'];
        if($data['password'] == $data['confirm_password']){
            $acc->password =Hash::make($data['password']);
        }else{
            return response()->json(['error'=>'Mật khẩu và xác nhận mật khẩu không khớp!'],400);
        }
        
        $acc->status = 1;
        $acc->isAdmin = 0;
        $acc->isSubAdmin = 0;
        $acc->address = null;
        $acc->dateOfBirth = null;
        $acc->life_heart = 3;
        $acc->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $acc->updated_at = null;


        $acc->save();
        $rank = new Ranking();
        $rank->user_id = $acc->id;
        $rank->score_single = 0;
        $rank->score_challenge = 0;
        $rank->save();
        $files = Storage::files('app/public/assets/no_avatar.png');

        

        Storage::copy('assets/no_avatar.png', 'account/'.$acc->id.'/avatar/no_avatar.png' );
        $file = Image::make(storage_path('app/public/assets/no_avatar.png'));
            $file->resize(360, 360, function ($constraint) {
                $constraint->aspectRatio();
            });
            $file->save(storage_path('app/public/account/'.$acc->id.'/avatar/no_avatar.png' ));
            $acc->avatar = 'no_avatar.png';
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

    
    public function loginWithGoogle(Request $request){
        
        $check = SocialAccount::where('provider_id', '=', $request->provider_id)->first();
        if(empty($check)){
            $nUser = new User();
            $nUser->email = $request->email;
            $nUser->display_name = $request->display_name;
            $nUser->save();

            $files = Storage::files('app/public/assets/no_avatar.png');
            Storage::copy('assets/no_avatar.png', 'account/'.$nUser->id.'/avatar/no_avatar.png' );
            $file = Image::make(storage_path('app/public/assets/no_avatar.png'));
            $file->resize(360, 360, function ($constraint) {
                $constraint->aspectRatio();
            });
            $file->save(storage_path('app/public/account/'.$nUser->id.'/avatar/no_avatar.png' ));
            $nUser->avatar = 'no_avatar.png';
            $nUser->save();

            $rank = new Ranking();
            $rank->user_id = $acc->id;
            $rank->score_single = 0;
            $rank->score_challenge = 0;
            $rank->save();

            $scl = new SocialAccount();
            $scl->provider = 'GOOGLE';
            $scl->provider_id = $request->provider_id;
            $scl->user_id = $nUser->id;
            $scl->save();
            
            $token = $nUser->createToken('authToken')->plainTextToken;
            return response()->json(['access_token' => $token,'token_type' => 'Bearer',],200);
        }else{
            //TODO đi vào đăng nhập
            $user = User::find($check->user_id);
            $token = $user->createToken('authToken')->plainTextToken;
            return response()->json(['access_token' => $token,'token_type' => 'Bearer','message'=>'Co san trong he thong'],200);
        }
    }

    public function getUser(Request $request){
        $ranking_single = DB::select('SELECT *,  
        DENSE_RANK() OVER (ORDER BY score_single DESC) dens_rank  
        FROM ranking;');

        $ranking_challenge =DB::select('SELECT *,  
        DENSE_RANK() OVER (ORDER BY score_challenge DESC) dens_rank  
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
                                'display_name'=>$request->user()->display_name,
                                'avatar'=>URL('storage/account/'.$request->user()->id.'/avatar/'.$request->user()->avatar),
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
       return response()->json(['message'=>'Đổi mật khẩu thành công!'],200);
        }
    }

    public function logout(Request $request){
        auth()->user()->tokens()->delete();
        return response()->json(['message'=>'Đăng xuất thành công!'],200);

    }


}