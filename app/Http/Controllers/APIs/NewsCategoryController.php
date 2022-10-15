<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsCategories;

class NewsCategoryController extends Controller
{
    public function getlstNewsCategory(){
        $lstNewsCategory = NewsCategories::WHERE('status',1)->get();
        return response( $lstNewsCategory, 200)
                  ->header('Content-Type', 'application/json');
    }
}