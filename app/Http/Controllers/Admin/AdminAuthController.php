<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function getPageLogin(){
        return view('admin.pages.login');
    }

    public function showUI(User $u){
        
    }

    public function login(Request $request){
        
        

        $data = $request->all();
        $arr = ['email'=>$data['email'],'password'=>$data['password']];
        $account = User::WHERE('email',$data['email'])->first();
        // dd(Hash::check($data['password'],$account->password),$data['password'],$account->password);
        if(!empty($account)){
            if(Hash::check($data['password'],$account->password)){
                
                if($account->isAdmin == 1){
                    if($account->status == 1){
                        if($account->isAdmin == 1)
                            $account->isAdmin = "Quản trị viên";
                        
                        Auth::login($account);
                        
                        return response()->json(['AUTH'=> Auth::user(),'message'=>'Đăng nhập thành công!','redirect_url'=>Route('page-account-admin')],200);
                    }
                    else{
                        return response()->json(['message'=>'Tài khoản đang bị khóa!','redirect_url'=>Route('page-account-admin')],400);
                    }
                }
                else{
                    return response()->json(['message'=>'Bạn không có quyền truy cập vào trang này!'],400);
                }
            }else
            {
                return response()->json(['message'=>'Mật khẩu không chính xác!'],400);
            }

        }
        else{
            return response()->json(['message'=>'Tài khoản không tồn tại!'],400);
        }
    }

    public function logout(){
        Auth::logout();
        return Redirect::Route('page-login');
    }
}