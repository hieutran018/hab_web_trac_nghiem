<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    public function getNewsById($id){
        $lstNews = News::WHERE('news_category_id',$id)->get();
        return response( $lstNews, 200)
                  ->header('Content-Type', 'application/json');
    }
}