<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Validator;

class AdminAccountUserController extends Controller
{
    public function getPageAccountUser(){
        return view('admin.pages.account_user');
    }

    public function infoAccountUser($id){
        $user = User::Find($id);
        
        if(empty($user)){
            return response()->json(['status'=>404,'message'=>'Không tìm thấy thông tin tài khoản!']);
        }else{
            return response()->json(['status'=>200,'user'=>$user]);
        }
    }

    public function updateAccountUser(Request $request){
        if(Auth::user()->isAdmin == 1){
            $validator = Validator::make($request->all(),
            [
                'display_name'=>'required',
                'email'=>'required',
                'phone_number' => 'required',
                'address'=>'required',
            ],
            [
                'display_name.required' =>'Tên người dùng không được bỏ trống!',
                'email.required' =>'Email không được bỏ trống!',
                'phone_number.required' => 'Số điện thoại không được bỏ trống!',
                'address.required' => 'Địa chỉ không được bỏ trống!' 
            ]);

            if($validator->fails()){
                return response()->json(['status'=>400,'message'=>$validator->errors()->toArray()]);
            }else{
            $data = $request->all();
            $account = User::WHERE('id',$request->id)->first();
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
                $account->phone_number = $data['phone_number'];
                $account->address = $data['address'];
                $account->dateOfBirth = $data['date_of_birth'];
                $account->status = $data['status'];
                
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
                return response()->json(['status'=>401,'message'=>'Không tìm thấy tài khoản!']);
            }
        }
        }else{
            return response()->json(['status'=>403,'message'=>'Bạn không có quyền thực hiện thao tác này!']);
        }
    }
    
}