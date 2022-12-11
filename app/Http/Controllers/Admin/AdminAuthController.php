<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminAuthController extends Controller
{
    public function getPageLogin(){
        return view('admin.pages.login');
    }

    public function showUI(User $u){
        
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
        // dd($validator->errors()->toArray());
        if($validator->fails()){
                return response()->json(['status'=>400,'message'=>$validator->errors()->toArray()]);
        }
        else{
            $data = $request->all();
            $arr = ['email'=>$data['email'],'password'=>$data['password']];
            $account = User::WHERE('email',$data['email'])->first();
            
            if(!empty($account)){
                if(Hash::check($data['password'],$account->password)){
                    
                    if($account->isAdmin == 1||$account->isSubAdmin == 1){
                        if($account->status == 1){
                            Auth::login($account);
                            
                            return response()->json(['status'=>200,'AUTH'=> Auth::user(),'message'=>'Đăng nhập thành công!','redirect_url'=>Route('page-account-admin')]);
                        }
                        else{
                            return response()->json(['status'=>400,'message'=>'Tài khoản đang bị khóa!']);
                        }
                    }
                    else{
                        return response()->json(['status'=>419,'message'=>'Bạn không có quyền truy cập vào trang này!']);
                    }
                }else
                {
                    return response()->json(['status'=>401,'message'=>'Mật khẩu không chính xác!']);
                }

            }
            else{
                return response()->json(['message'=>'Tài khoản không tồn tại!'],400);
            }
        }

        
    }

    public function logout(){
        Auth::logout();
        return Redirect::Route('page-login');
    }
}