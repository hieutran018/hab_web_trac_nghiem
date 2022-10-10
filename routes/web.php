<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminAccountController;
use App\Http\Controllers\Admin\AdminAccountUserController;

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
    Route::POST('/admin/account-admin/update-account-admin',[AdminAccountController::class,'updateAccountAdmin'])->name('update-account-admin')->middleware('checkadmin::class');
});

//* Trang quản lý tài khoản admin

//* Trang quản lý tài khoản user
Route::GET('/admin/account-user',[AdminAccountUserController::class,'getPageAccountUser'])->name('page-account-user');

Route::get('/layout',function(){
    return view('admin.pages.login');
});