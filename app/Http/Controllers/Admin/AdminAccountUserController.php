<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminAccountUserController extends Controller
{
        public function getPageAccountUser(){
        return view('admin.pages.account_user');
    }

    
}