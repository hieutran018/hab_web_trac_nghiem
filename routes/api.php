<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIs\AuthController;
use App\Http\Controllers\APIs\NewsCategoryController;

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


Route::get('/news/news-category',[NewsCategoryController::class,'getlstNewsCategory']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return response()->json(['id'=>$request->user()->id,
                            'first_name'=>$request->user()->first_name,
                            'last_name'=>$request->user()->last_name,
                            'avatar'=>$request->user()->avatar,
                            'email'=>$request->user()->email,
                            'phone'=>$request->user()->phone_number,
                            'address'=>$request->user()->address,
                            'date_of_birth'=>$request->user()->dateOfBirth,
                            'life_heart'=>$request->user()->life_heart,
                        ],200);
});