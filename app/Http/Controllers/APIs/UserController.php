<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

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

    public function getDataUser($id){
        $user = User::Find($id);
        if(empty($user)){
            return response()->json('Không thể tìm thấy tài khoản này!',404);
        }else{
            return response()->json($user,200);
        }
    }
}