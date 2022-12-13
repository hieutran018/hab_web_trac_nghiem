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
                return response()->json(['status'=>400,'message'=>'Tài khoản không tồn tại!']);
            }
        }
    }

    public function showInfoAccountCurrent(){
        $user = User::Find(Auth::user()->id);
        return response()->json(['status'=>200,'user'=>$user]);
    }

    public function logout(){
        Auth::logout();
        return Redirect::Route('page-login');
    }

    public function updateAccountCurrent(Request $request){
        $validator = Validator::make($request->all(),
            [
                'email'=>'required',
                'display_name'=>'required',
                'phone_number' => 'required',
                'address'=>'required',
                
            ],
            [
                'email.required'=>'Email không được bỏ trống!',
                'display_name.required' =>'Họ tên không được bỏ trống!',
                'phone_number.required' => 'Số điện thoại không được bỏ trống!',
                'address.required' => 'Địa chỉ không được bỏ trống!'
                
            ]);

        if($validator->fails()){
                return response()->json(['status'=>400,'message'=>$validator->errors()->toArray()]);
            }else{
            $data = $request->all();
            
            $account = User::Find(Auth::user()->id);
            
            if(!empty($account)){
                if($account->email != $data['email']){
                    $validator = Validator::make($request->all(),['email'=>'unique:users'],['email.unique'=>'Email này đã được sử dụng!']);
                    if($validator->fails()){
                        return response()->json(['status'=>400,'message'=>$validator->errors()->toArray()]);
                    }else{
                        $account->email = $data['email'];
                    }
                }
                $account->display_name = $data['display_name'];
                $account->display_name = $data['display_name'];
                $account->phone_number = $data['phone_number'];
                $account->address = $data['address'];
                $account->dateOfBirth = $data['date_of_birth'];

            //Cập nhật ảnh đại diện
            if ($request->hasFile('avatar')) {
            $fileExtentsion = $request->file('avatar')->getClientOriginalExtension();
            $fileName = time().'.'.$fileExtentsion;
            $request->file('avatar')->storeAs('account/'.$account->id.'/avatar/', $fileName);
            $file = Image::make(storage_path('app/public/account/'.$account->id.'/avatar/' . $fileName));
            $file->resize(360, 360, function ($constraint) {
                $constraint->aspectRatio();
            });
            $file->save(storage_path('app/public/account/'.$account->id.'/avatar/' . $fileName));
                $account->avatar = $fileName;
            }
                $account->update();
                return response()->json(['status'=>200,'message'=>'Cập nhật tài khoản thành công!','data'=>$data]);
            }
            else{
                return response()->json(['status'=>400,'message'=>'Không tìm thấy tài khoản!']);
            }
        }

    }

    public function changePasswordAccountCurrent(Request $request){

        $validator = Validator::make($request->all(),
            [
                'old_password' => 'required',
                'password' => 'required',
                'confirm_password' => 'required',
            ],
            [
                'old_password.required' => 'Mật khẩu cũ không được bỏ trống!',
                'password.required' => 'Mật khẩu mới không được bỏ trống!',
                'confirm_password.required' => 'Mật khẩu không được bỏ trống!',
                
            ]);
        if($validator->fails()){
            return response()->json(['status'=>400,'message'=>$validator->errors()->toArray()]);
        }
        else{
            $id = Auth::user()->id;
            $data = $request->all();
            $user = User::Find($id);

            if(Hash::check($data['old_password'],$user->password)){
                if($data['password'] === $data['confirm_password']){
                    $user->password = Hash::make($data['password']);
                    $user->update();
                    return response()->json(['status'=>200,'message'=>'Thay đổi mật khẩu thành công!']);
                }else{
                    return response()->json(['status'=>401,'message'=>'Mật khẩu mới và xác nhận mật khẩu mới không khớp!']);
                }
            }else{
                return response()->json(['status'=>401,'message'=>'Mật khẩu cũ không đúng!']);
            }
        }
        
    }
    
}