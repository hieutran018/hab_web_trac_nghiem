<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsCategories;
use Carbon\Carbon;

class NewsCategoryController extends Controller
{
    public function getlstNewsCategory(){
        $lstNewsCategory = NewsCategories::WHERE('status',1)->get();
        foreach($lstNewsCategory as $newsCategory){
            $newsCategory->created_at = Carbon::parse($newsCategory->created_at)->format('d-m-Y\TH:i:s.vp');
        }
        return response( $lstNewsCategory, 200)
                  ->header('Content-Type', 'application/json');
    }
}