<?php

use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\User\Usercontroller;
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

//user auth
Route::post('/user/login',[UserAuthController::class, 'login']);
Route::post('/user/logout',[UserAuthController::class, 'logout']);

//user
Route::get('/user',[Usercontroller::class, 'index']);
Route::get('/user/{id}',[Usercontroller::class, 'show']);
Route::post('/user',[Usercontroller::class, 'create']);
Route::put('/user/{id}',[Usercontroller::class, 'update']);
Route::delete('/user/{id}',[Usercontroller::class, 'destroy']);