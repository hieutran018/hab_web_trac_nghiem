<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function updateInfoUser(Request $request){
        $userId = $request->user()->id;

        $user = User::Find($userId);
        if(empty($user)){
            return response()->json('Không tìm thấy tài khoản trong hệ thống!',401);
        }else{
            $user->displaye_name = $request->display_name;
            $user->phone_number = $request->phone_number;
            $user->address = $request->address;
            $user->dateOfBirth = $request->date_of_birth;
            $user->update();
        }
    }
}