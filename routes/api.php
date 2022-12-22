<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIs\AuthController;
use App\Http\Controllers\APIs\NewsCategoryController;
use App\Http\Controllers\APIs\RankingController;
use App\Http\Controllers\APIs\TopicQuestionController;
use App\Http\Controllers\APIs\LevelQuestionController;
use App\Http\Controllers\APIs\NewsController;
use App\Http\Controllers\APIs\UserController;
use App\Http\Controllers\APIs\QuestionController;
use App\Http\Controllers\APIs\GameController;
use App\Http\Controllers\APIs\MatchHistoryController;
use App\Http\Controllers\APIs\NotifiController;
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

Route::POST('/login-with-google',[AuthController::class,'loginWithGoogle']);

Route::GET('/user/edit-info-user',[UserController::class,'editInfoUser'])->middleware('auth:sanctum');
Route::POST('/user/update-info-user',[UserController::class,'updateInfoUser'])->middleware('auth:sanctum');
Route::POST('/user/get-data-user',[UserController::class,'getDataUser']);


Route::get('/news/news-category',[NewsCategoryController::class,'getlstNewsCategory']);

Route::get('/news/fetch-news',[NewsController::class,'getNews']);
Route::GET('/news/fetch-news-by-category/id={id}',[NewsController::class,'getNewsById']);
Route::GET('/news/detail-news/id={id}',[NewsController::class,'getDetailNews']);

Route::get('/ranking-challenge',[RankingController::class,'getListRankingChallenge']);
Route::get('/ranking-single',[RankingController::class,'getListRankingSingle']);
Route::GET('/topic-quesiton',[TopicQuestionController::class,'getTopicQuestion']);
Route::POST('/get-topic-by-id',[TopicQuestionController::class,'getTopicById']);
Route::GET('/level-quesiton',[LevelQuestionController::class,'getLevelQuestion']);
Route::POST('/get-level-by-id',[LevelQuestionController::class,'getLevelById']);

Route::GET('/games/get-list-user-game-challenge',[UserController::class,'getlistRandUser'])->middleware('auth:sanctum');
Route::POST('/games/create-match-challenge',[GameController::class,'createMatchChallenge'])->middleware('auth:sanctum');

Route::POST('/match-history',[MatchHistoryController::class,'getMatchHistory']);
Route::POST('/match-history/history-detail',[MatchHistoryController::class,'getMatchHistorySingleDetail']);
Route::POST('/match-history/history-challenge-detail',[MatchHistoryController::class,'getMatchHistoryChallengeDetail']);

Route::POST('/save-answer',[GameController::class,'saveAnswer']);

Route::POST('/question',[QuestionController::class,'randQuestion']);

Route::POST('/games/create-match-single',[GameController::class,'createMatchSingle'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->get('/user', [AuthController::class,'getUser']);

Route::GET('/notification',[NotifiController::class,'getListNotifi'])->middleware('auth:sanctum');

Route::POST('/games/accept-game-challenge',[GameController::class,'acceptedGame']);
Route::POST('/games/create-accept-game-challenge',[GameController::class,'saveAcceptGameChallenge'])->middleware('auth:sanctum');