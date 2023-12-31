<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::post('login',[AuthController::class,'login']);

Route::group(['middleware'=>['jwt_verify']],function(){
    Route::post('register',[AuthController::class,'register']);
    //Route::post('logout',[AuthController::class,'logout']);
    Route::get('users',[\App\Http\Controllers\UserController::class,'index']);
    Route::get('user/{id}',[\App\Http\Controllers\UserController::class,'show']);
    Route::get('client/{client}',[\App\Http\Controllers\ClientController::class,'show']);
});
