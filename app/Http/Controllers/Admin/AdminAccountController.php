<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AdminAccountController extends Controller
{
    public function getPageAccountAdmin(){
        return view('admin.pages.account');
    }

    public function getPageAccountUser(){
        return view();
    }

    public function getListAccountAdmin(){
        $lst = User::WHERE('isAdmin',1);
        return response()->json(['lst'=>$lst]);
    }

    public function createAccountAdmin(Request $request){
        $data = $request->all();
        return response()->json(['data'=>$data]);
    }
    
}