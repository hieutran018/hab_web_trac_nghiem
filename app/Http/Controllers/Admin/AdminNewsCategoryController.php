<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminNewsCategoryController extends Controller
{
    public function getPageNewsCategories(){
        return view('admin.pages.news_categories');
    }
}