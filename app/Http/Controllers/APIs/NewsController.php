<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{

    public function getNews(){
        $lstNews = News::all();
        foreach($lstNews as $news){
            $news->user_id = $news->user->first_name.' '.$news->user->last_name;
            $news->news_category_id = $news->newscategory->news_category_name;
            $news->image = asset('storage/news/'.$news->image);
        }
        return response()->json($lstNews,200);
    }

    public function getNewsById($id){
        $lstNews = News::WHERE('news_category_id',$id)->get();
        return response( $lstNews, 200)
                  ->header('Content-Type', 'application/json');
    }

    public function getDetailNews($id){
        $news = News::WHERE('id',$id)->first();
        return response( $news, 200)
                  ->header('Content-Type', 'application/json');
    }
}