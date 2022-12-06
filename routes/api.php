<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIs\AuthController;
use App\Http\Controllers\APIs\NewsCategoryController;
use App\Http\Controllers\APIs\RankingController;
use App\Http\Controllers\APIs\TopicQuestionController;
use App\Http\Controllers\APIs\NewsController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::POST('/register-account',[AuthController::class,'register']);
Route::POST('/login',[AuthController::class,'login']);
Route::POST('/logout',[AuthController::class,'logout'])->middleware('auth:sanctum');
Route::POST('/change-password',[AuthController::class,'changePassword'])->middleware('auth:sanctum');
Route::POST('/user/update-info-user');


Route::get('/news/news-category',[NewsCategoryController::class,'getlstNewsCategory']);

Route::get('/news/fetch-news',[NewsController::class,'getNews']);
Route::GET('/news/fetch-news-by-category/id={id}',[NewsController::class,'getNewsById']);
Route::GET('/news/detail-news/id={id}',[NewsController::class,'getDetailNews']);

Route::get('/ranking-challenge',[RankingController::class,'getListRankingChallenge']);
Route::get('/ranking-single',[RankingController::class,'getListRankingSingle']);
Route::GET('/topic-quesiton',[TopicQuestionController::class,'getTopicQuestion']);

Route::middleware('auth:sanctum')->get('/user', [AuthController::class,'getUser']);