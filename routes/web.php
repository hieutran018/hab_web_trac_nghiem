<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminAccountController;

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
})->middleware('checklogin::class');

Route::GET('/admin/login',[AdminAuthController::class,'getPageLogin'])->name('page-login');
Route::POST('/admin/login-post',[AdminAuthController::class,'login'])->name('login-admin');

Route::GET('/admin/logout',[AdminAuthController::class,'logout'])->name('logout-admin');

//* Trang quản lý tài khoản admin
Route::GET('/admin/account',[AdminAccountController::class,'getPageAccountAdmin'])->name('page-account-admin');
Route::GET('/admin/account/list-account-admin',[AdminAccountController::class,'getListAccountAdmin'])->name('get-list-account-admin');
Route::POST('/admin/account/create-account-admin',[AdminAccountController::class,'createAccountAdmin'])->name('create-account-admin');