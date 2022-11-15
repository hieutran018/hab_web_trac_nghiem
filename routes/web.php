<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminAccountController;
use App\Http\Controllers\Admin\AdminAccountUserController;
use App\Http\Controllers\Admin\AdminNewsCategoryController;
use App\Http\Controllers\Admin\AdminTopicQuestionController;
use App\Http\Controllers\Admin\AdminLevelController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::GET('/', function () {
    return redirect("/admin/login");
});

Route::GET('/admin/login',[AdminAuthController::class,'getPageLogin'])->name('page-login');
Route::POST('/admin/login-post',[AdminAuthController::class,'login'])->name('login-admin');

Route::GET('/admin/logout',[AdminAuthController::class,'logout'])->name('logout-admin');


Route::group(['middleware'=>'checklogin'],function(){
    Route::GET('/admin/checkisAdmin',[AdminAccountController::class,'checkIsAdmin'])->name('checkisAdmin')->middleware('checkadmin::class');
    Route::GET('/admin/account-admin',[AdminAccountController::class,'getPageAccountAdmin'])->name('page-account-admin');
    Route::GET('/admin/account-user',[AdminAccountController::class,'getPageAccountUser'])->name('page-account-user');
    Route::GET('/admin/account-admin/list-account-admin',[AdminAccountController::class,'getListAccountAdmin'])->name('get-list-account-admin');
    Route::GET('/admin/account-admin/list-account-user',[AdminAccountController::class,'getListAccountUser'])->name('get-list-account-admin');
    Route::POST('/admin/account-admin/create-account-admin',[AdminAccountController::class,'createAccountAdmin'])->name('create-account-admin');
    Route::GET('/admin/account-admin/info-account-admin/id={id}',[AdminAccountController::class,'infoAccountAdmin'])->name('info-account-admin');
    Route::GET('/admin/account-admin/edit-account-admin/id={id}',[AdminAccountController::class,'editAccountAdmin'])->name('edit-account-admin')->middleware('checkadmin::class');
    Route::PUT('/admin/account-admin/update-account-admin',[AdminAccountController::class,'updateAccountAdmin'])->name('update-account-admin')->middleware('checkadmin::class');
});

//* Trang quản lý tài khoản user
Route::GET('/admin/account-user',[AdminAccountUserController::class,'getPageAccountUser'])->name('page-account-user');

Route::GET('/admin/news/news-categories',[AdminNewsCategoryController::class,'getPageNewsCategories'])->name('get-page-news-category');
Route::GET('/admin/news/news-categories/fetch-news-category',[AdminNewsCategoryController::class,'getNewsCategory'])->name('fetch-news-category');
Route::POST('/admin/news/news-categories/create-news-category',[AdminNewsCategoryController::class,'createNewsCatetogy'])->name('create-news-category');
Route::GET('/admin/news/news-categories/edit-news-category/id={id}',[AdminNewsCategoryController::class,'editNewsCategory'])->name('edit-news-category');
Route::POST('/admin/news/news-categories/update-news-category',[AdminNewsCategoryController::class,'updateNewsCategory'])->name('update-news-category');


//* Topic Question -------------------------------------------------------------------------------------------------------------------------------
Route::GET('/admin/games/topic-questions',[AdminTopicQuestionController::class,'getPageTopicQuestion'])->name('get-page-topic-question');
Route::GET('/admin/games/topic-questions/fetch-topic-questions',[AdminTopicQuestionController::class,'getToipicQuestion']);
Route::POST('/admin/games/topic-questions/create-topic-questions',[AdminTopicQuestionController::class,'createTopicQuestion']);
Route::GET('/admin/games/topic-questions/edit-topic-questions/id={id}',[AdminTopicQuestionController::class,'editTopicQuestion']);
Route::POST('/admin/games/topic-questions/update-topic-questions',[AdminTopicQuestionController::class,'updateTopicQuestion']);
Route::GET('/admin/games/topic-questions/delete-topic-questions/id={id}',[AdminTopicQuestionController::class,'deleteTopicQuestion']);

//* LevelQuestion -----------------------------------------------------------------------------------------------------------------------------------------------
Route::GET('/admin/games/level-questions',[AdminLevelController::class,'getPageLevelQuestion'])->name('get-page-level-question');
Route::GET('/admin/games/level-questions/fetch-level-questions',[AdminLevelController::class,'getLevelQuestion']);
Route::POST('/admin/games/level-questions/create-level-questions',[AdminLevelController::class,'createLevelQuestion']);
Route::GET('/admin/games/level-questions/edit-level-questions/id={id}',[AdminLevelController::class,'editLevelQuestion']);
Route::POST('/admin/games/level-questions/update-level-questions',[AdminLevelController::class,'updateTopicQuestion']);
Route::GET('/admin/games/level-questions/delete-level-questions/id={id}',[AdminLevelController::class,'deleteTopicQuestion']);
// Route::get('/layout',function(){
//     return view('admin.pages.login');
// });