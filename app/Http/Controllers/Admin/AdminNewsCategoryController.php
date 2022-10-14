<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsCategories;

class AdminNewsCategoryController extends Controller
{
    public function getPageNewsCategories(){
        return view('admin.pages.news_categories');
    }
    public function getNewsCategory(){
        $newsCategory = NewsCategories::Get();
        return response()->json(['status'=>200,'newsCategory'=>$newsCategory]);
    }
}