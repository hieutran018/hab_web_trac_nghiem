<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Image;
use Auth;

class AdminAccountController extends Controller
{
    public function getPageAccountAdmin(){
        return view('admin.pages.account_admin');
    }

    public function getPageAccountUser(){
        return view('admin.pages.account_user');
    }

    public function getListAccountAdmin(){
        $lst = User::WHERE('isAdmin',1)->orWHERE('isSubAdmin',1)->get();
        return response()->json(['status'=>200,'lst'=>$lst]);
    }

    public function infoAccountAdmin($id){
        $account = User::WHERE('id',$id)->first();
        if(empty($account)){
            return response()->json(['status'=>400,'message'=>'Không tìm thấy thông tin tài khoản này!']);
        }else{
            return response()->json(['status'=>200,'account'=>$account]);
        }
    }

    public function editAccountAdmin($id){
        if(Auth::user()->isAdmin == 1){
            $account = User::find($id);
            if(empty($account)){
                return response()->json(['status'=>400,'Tài khoản này không tồn tại!']);
            }else{
                return response()->json(['status'=>200,'account'=>$account]);
            }
        }else{
            return response()->json(['status'=>403,'message'=>'Bạn không có quyền thực hiện thao tác này!']);
        }
        
        
    }

    public function updateAccountAdmin(Request $request){

        $validator = Validator::make($request->all(),
            [
                'display_name'=>'required',
                'phone_number' => 'required',
                'address'=>'required',
            ],
            [
                'display_name.required' =>'Họ tên không được bỏ trống!',
                'phone_number.required' => 'Số điện thoại không được bỏ trống!',
                'address.required' => 'Địa chỉ không được bỏ trống!'
            ]);

        if($validator->fails()){
                return response()->json(['status'=>400,'message'=>$validator->errors()->toArray()]);
            }else{
            $data = $request->all();
            
            $account = User::WHERE('id',$request->id)->first();
            if(!empty($account)){
                $account->display_name = $data['display_name'];
                $account->phone_number = $data['phone_number'];
                $account->address = $data['address'];
                $account->dateOfBirth = $data['date_of_birth'];
                if($data['status'] != $account->status){
                    if(Auth::user()->id == $account->id){
                        return response()->json(['status'=>401,'message'=> 'Bạn không thể cập nhật trạng thái tài khoản đang đăng nhập hiện tại! ']);
                    }else{
                        $account->status = $data['status'];
                    }
                }
               
                if($data['position'] != $account->isAdmin && $data['position'] != $account->isSubAdmin){
                    if(Auth::user()->id == $account->id){
                        return response()->json(['status'=>401,'message'=> 'Bạn không thể cập nhật vị trí tài khoản đang đăng nhập hiện tại! ']);
                    }else{
                        if($data['position'] == 1){
                            $account->isAdmin = 1;
                            $account->isSubAdmin = 0;
                        }else{
                            $account->isAdmin = 0;
                            $account->isSubAdmin = 1;
                        }
                    }
                }
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

    public function getListAccountUser(){
        $lst = User::WHERE('isAdmin',0)->WHERE('isSubAdmin',0)->get();
        // dd($lst);
        foreach($lst as $user){
            if($user->phone_number == null){
                $user->phone_number ='Chưa có thông tin';
            }
        }
        return response()->json(['status'=>200,'lst'=>$lst]);
    }

    public function createAccountAdmin(Request $request){
        $validator = Validator::make($request->all(),
            [
                'display_name'=>'required',
                'email' => 'required|email|unique:users',
                'password' => 'required',
                'confirm_password'=> 'required',
                'phone_number' => 'required',
                'address'=>'required',
                'avatar' => 'image|mimes:jpeg,png,jpg|max:2048',
            ],
            [
                'display_name.required' =>'Tên người dùng không được bỏ trống!',
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

                    
                    $acc->display_name = $data['display_name'];
                    $acc->email = $data['email'];
                    $acc->phone_number = $data['phone_number'];
                    $acc->life_heart = 0;
                    
                    if($data['password'] == $data['confirm_password']){
                        $acc->password =Hash::make($data['password']);
                    }
                    else{
                        return response()->json(['status'=>417,'error_password'=>'Mật khẩu và xác nhận mật khẩu không giống nhau!']);
                    }
                    if($data['position'] == 1){
                        $acc->isAdmin = 1;
                        $acc->isSubAdmin = 0;
                    }
                    elseif($data['position'] == 2){
                        $acc->isAdmin = 0;
                        $acc->isSubAdmin = 1;
                    }
                    $acc->status = 1;
                    
                    $acc->address = $data['address'];
                    $acc->dateOfBirth = $data['date_of_birth'];
                    $acc->created_at = Carbon::now('Asia/Ho_Chi_Minh');
                    $acc->updated_at = null;
                    $acc->save();

                    //Thêm ảnh đại diện
                    if ($request->hasFile('avatar')) {
                    $fileExtentsion = $request->file('avatar')->getClientOriginalExtension();
                    $fileName = time().'.'.$fileExtentsion;
                    $request->file('avatar')->storeAs('account/'.$acc->id.'/avatar/', $fileName);
                    $file = Image::make(storage_path('app/public/account/'.$acc->id.'/avatar/' . $fileName));
                    $file->resize(360, 360, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $file->save(storage_path('app/public/account/'.$acc->id.'/avatar/' . $fileName));
                        $acc->avatar = $fileName;
                        $acc->save();
                    }
                    
                    return response()->json(['status'=>200,'msg'=>$data]);
            }
        
    }
    
    public function deleteAccountAdmin($id){
        if(Auth::user()->isAdmin == 1){
            $acc = User::find($id);
            if(empty($acc)){
                return response()->json(['status'=>400,'message'=>'Có lỗi xảy ra, vui lòng thử lại sau!']);
            }
            else{
                if($acc->isAdmin == 1 && $acc->isSubAdmin == 0){
                        return response()->json(['status'=>400,'message'=>'Bạn không thể xóa tài khoản quản trị viên này!']);
                }elseif($acc->isAdmin == 0 && $acc->isSubAdmin == 1){
                    $acc->delete();
                    return response()->json(['status'=>200,'message'=>'Xóa tài khoản thành công!']);
                }
            }
        }else{
            return response()->json(['status'=>400,'message'=>'Bạn không có quyền thực hiện thao tác này!']);
        }
        
    }
    //* USER

    
    public function deleteAccountUser($id){
        if(Auth::user()->isAdmin == 1){
            $acc = User::find($id);
            if(empty($acc)){
                return response()->json(['status'=>400,'message'=>'Có lỗi xảy ra, vui lòng thử lại sau!']);
            }
            else{
                $acc->delete();
                return response()->json(['status'=>200,'message'=>'Xóa tài khoản thành công!']);
            }
        }else{
            return response()->json(['status'=>400,'message'=>'Bạn không có quyền thực hiện thao tác này!']);
        }
    }

    public function changePassword(Request $request){
        $validator = Validator::make($request->all(),
            [
                
                'password'=>'required',
                'confirm_password' => 'required',
            ],
            [
                
                'password.required' => 'Mật khẩu mới không được bỏ trống!',
                'confirm_password.required' => 'Xác nhận mật khẩu không được bỏ trống!'
                
            ]);

        if($validator->fails()){
            return response()->json(['status'=>400,'message'=>$validator->errors()->toArray()]);
        }else{
            $user = User::Find($request->id);
            if(empty($user)){
                return response()->json(['status'=>401,'message'=>'Không tìm thấy tài khoản này!']);
            }else{
                if($request->password == $request->confirm_password){
                    $user->password = Hash::make($request->password);
                    $user->update();
                    return response()->json(['status'=>200,'message'=>'Thay đổi mật khẩu thành công!']);
                }else{
                   return response()->json(['status'=>409,'message'=>'Mật khẩu mới và xác nhận mật khẩu không trùng khớp!']); 
                }
                
            }
        }
    }

}