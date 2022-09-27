<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminAccountController extends Controller
{
    public function getPageAccountAdmin(){
        return view('admin.pages.account_admin');
    }

    public function getPageAccountUser(){
        return view();
    }

    public function getListAccountAdmin(){
        $lst = User::WHERE('isAdmin',1);
        return response()->json(['lst'=>$lst]);
    }

    public function createAccountAdmin(Request $request){
        $validator = Validator::make($request->all(),
            [
                'first_name'=>'required',
                'last_name'=>'required',
                'email' => 'required|email|unique:users',
                'password' => 'required',
                'confirm_password'=> 'required',
                'phone_number' => 'required',
                'address'=>'required',
                'avatar' => 'image|mimes:jpeg,png,jpg|max:2048',
            ],
            [
                'first_name.required' =>'Họ tên không được bỏ trống!',
                'last_name.required' =>'Tên không được bỏ trống!',
                'email.required' => 'Email không được bỏ trống!',
                'email.email' => 'Email này không hợp lệ!',
                'email.unique' => 'Email này đã được sử dụng ở một tài khoản khác!',
                'password.required' => 'Mật khẩu không được bỏ trống!',
                'confirm_password.required' => 'Xác nhận mật khẩu không được bỏ trống!',
                'phone_number.required' => 'Số điện thoại không được bỏ trống!',
                'address.required' => 'Địa chỉ không được bỏ trống!'
                
            ]);
        
            if($validator->fails()){
                return response()->json(['status'=>400,'message'=>$validator->errors()->toArray()]);
            }else{
                $data = $request->all();

                $acc = new User();

                $acc->first_name = $data['first_name'];
                $acc->last_name = $data['last_name'];
                $acc->email = $data['email'];
                $acc->phone_number = $data['phone_number'];
                if($data['password'] == $data['confirm_password']){
                    $acc->password =Hash::make($data['password']);
                }
                else{
                    return response()->json(['status'=>400,'error_password'=>'Mật khẩu và xác nhận mật khẩu không giống nhau!']);
                }
                $acc->status = 1;
                $acc->isAdmin = 1;
                $acc->isSubAdmin = 1;
                $acc->address = $data['address'];
                $acc->dateOfBirth = $data['date_of_birth'];
                $acc->created_at = Carbon::now('Asia/Ho_Chi_Minh');
                $acc->updated_at = null;
                $acc->save();
                // if($request->hasFile('avatar'))
                // {
                //     return response()->json(['check file'=> 'CO FILE','data'=>$data]);
                // }
                // else{
                //     return response()->json(['check file'=> 'KHONG CO FILE','data'=>$data]);
                // }
                return response()->json(['status'=>200,'msg'=>$data]);
            }
        
    }
    
}