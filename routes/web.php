<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminAccountController;
use App\Http\Controllers\Admin\AdminAccountUserController;
use App\Http\Controllers\Admin\AdminNewsCategoryController;
use App\Http\Controllers\Admin\AdminNewsController;
use App\Http\Controllers\Admin\AdminTopicQuestionController;
use App\Http\Controllers\Admin\AdminLevelController;
use App\Http\Controllers\Admin\AdminQuestionController;

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
    Route::get('/admin/dashboard',[DashboardController::class,'getDashboad'])->name('get-page-dashboard');
    Route::get('/admin/dashboard/ranking',[DashboardController::class,'getListRankingChallengeDashBoard']);
    Route::GET('/admin/info-account-current',[AdminAuthController::class,'showInfoAccountCurrent']);
    Route::PUT('/admin/update-account-current',[AdminAuthController::class,'updateAccountCurrent']);
    Route::POST('/admin/change-password-account-current',[AdminAuthController::class,'changePasswordAccountCurrent']);

    Route::GET('/admin/checkisAdmin',[AdminAccountController::class,'checkIsAdmin'])->name('checkisAdmin')->middleware('checkadmin::class');
    Route::GET('/admin/account-admin',[AdminAccountController::class,'getPageAccountAdmin'])->name('page-account-admin');
    Route::GET('/admin/account-user',[AdminAccountController::class,'getPageAccountUser'])->name('page-account-user');
    Route::GET('/admin/account-admin/list-account-admin',[AdminAccountController::class,'getListAccountAdmin'])->name('get-list-account-admin');

    Route::POST('/admin/account-admin/create-account-admin',[AdminAccountController::class,'createAccountAdmin'])->name('create-account-admin');
    Route::GET('/admin/account-admin/info-account-admin/id={id}',[AdminAccountController::class,'infoAccountAdmin'])->name('info-account-admin');
    Route::GET('/admin/account-admin/edit-account-admin/id={id}',[AdminAccountController::class,'editAccountAdmin'])->name('edit-account-admin');
    Route::PUT('/admin/account-admin/update-account-admin',[AdminAccountController::class,'updateAccountAdmin'])->name('update-account-admin');
    Route::GET('/admin/account-admin/delete-account-admin/id={id}',[AdminAccountController::class,'deleteAccountAdmin'])->name('delete-account-admin');

    //* Trang qu???n l?? t??i kho???n user
    Route::GET('/admin/account-user',[AdminAccountUserController::class,'getPageAccountUser'])->name('page-account-user');
    Route::GET('/admin/account-admin/list-account-user',[AdminAccountController::class,'getListAccountUser'])->name('get-list-account-admin');
    Route::GET('/admin/account-user/info-account-user/id={id}',[AdminAccountUserController::class,'infoAccountUser']);
    Route::POST('/admin/account/account-user/update',[AdminAccountUserController::class,'updateAccountUser']);
    Route::POST('/admin/account/account-user/change-password',[AdminAccountController::class,'changePassword']);
    Route::GET('/admin/account-admin/delete-account-user/id={id}',[AdminAccountController::class,'deleteAccountUser'])->name('delete-account-user');

    Route::GET('/admin/news/news-categories',[AdminNewsCategoryController::class,'getPageNewsCategories'])->name('get-page-news-category');
    Route::GET('/admin/news/news-categories/fetch-news-category',[AdminNewsCategoryController::class,'getNewsCategory'])->name('fetch-news-category');
    Route::POST('/admin/news/news-categories/create-news-category',[AdminNewsCategoryController::class,'createNewsCatetogy'])->name('create-news-category');
    Route::GET('/admin/news/news-categories/edit-news-category/id={id}',[AdminNewsCategoryController::class,'editNewsCategory'])->name('edit-news-category');
    Route::POST('/admin/news/news-categories/update-news-category',[AdminNewsCategoryController::class,'updateNewsCategory'])->name('update-news-category');
    Route::GET('/admin/news/news-categories/delete-news-category/id={id}',[AdminNewsCategoryController::class,'deleteNewsCategory'])->name('delete-news-category');

    //* News
    Route::GET('/admin/news/news',[AdminNewsController::class,'getPageNews'])->name('get-page-news');
    Route::GET('/admin/news/fetch-news',[AdminNewsController::Class,'getNews']);
    Route::POST('/admin/news/create-news',[AdminNewsController::class,'createNews']);
    Route::GET('/admin/news/news-detail/id={id}',[AdminNewsController::class,'getNewsDetail']);
    Route::GET('/admin/news/news-edit/id={id}',[AdminNewsController::class,'editNews']);
    Route::POST('/admin/news/update-news',[AdminNewsController::class,'updateNews']);
    Route::GET('/admin/news/delete-news/id={id}',[AdminNewsController::class,'deleteNews']);

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
    Route::POST('/admin/games/level-questions/update-level-questions',[AdminLevelController::class,'updateLevelQuestion']);
    Route::GET('/admin/games/level-questions/delete-level-questions/id={id}',[AdminLevelController::class,'deleteLevelQuestion']);

    //* Question ----------------------------------------------------------------------------------------------------------------------------------------------------
    Route::GET('/admin/games/questions',[AdminQuestionController::class,'getPageQuestion'])->name('get-page-question');
    Route::GET('/admin/games/questions/fetch-question',[AdminQuestionController::class,'getQuestion']);
    Route::POST('/admin/games/questions/create-question',[AdminQuestionController::class,'createQuestion']);
    Route::GET('/admin/games/questions/edit-question/id={id}',[AdminQuestionController::class,'editQuestion']);
    Route::POST('/admin/games/questions/update-questions',[AdminQuestionController::class,'updateQuestion']);
});








// Route::GET('/admin/games/questions/fetch-questions',[AdminQuestionController::class,'getQuestion']);
// Route::POST('/admin/games/questions/create-questions',[AdminQuestionController::class,'createQuestion']);
// Route::GET('/admin/games/questions/edit-questions/id={id}',[AdminQuestionController::class,'editQuestion']);

// Route::GET('/admin/games/questions/delete-questions/id={id}',[AdminQuestionController::class,'deleteQuestion']);
// Route::get('/layout',function(){
//     return view('admin.pages.login');
// });