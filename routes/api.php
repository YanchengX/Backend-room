<?php

use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\Message\MessageHandleController;
use App\Http\Controllers\Room\RoomController;
use App\Http\Controllers\Room\RoomHandleController;
use App\Http\Controllers\User\Usercontroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Mailer\Messenger\MessageHandler;

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

Route::group(['middleware' => ['action.log']],function(){
    
    Route::post('/user/login',[UserAuthController::class, 'login']);

});

Route::group(['middleware'=> ['auth:api']],function(){

    Route::post('/user/logout',[UserAuthController::class, 'logout']);

    //user
    Route::get('/user',[Usercontroller::class, 'index']);
    Route::get('/user/{id}',[Usercontroller::class, 'show']);
    Route::post('/user',[Usercontroller::class, 'create']);
    Route::put('/user/{id}',[Usercontroller::class, 'update']);
    Route::delete('/user/{id}',[Usercontroller::class, 'destroy']);

    //room
    Route::get('/room', [RoomController::class, 'index']);
    Route::get('/room/{id}', [RoomController::class, 'show']);
    Route::post('/room', [RoomController::class, 'create']);
    Route::patch('/room/{id}', [RoomController::class, 'update']);
    Route::delete('/room/{id}', [RoomController::class, 'destroy']);

    //room handle
    Route::post('/room/key/{id}', [RoomHandleController::class, 'getKey']);
    Route::post('/room/join', [RoomHandleController::class, 'userJoin']);
    Route::post('/room/left/{id}', [RoomHandleController::class, 'userLeft']);

    //msg handle
    Route::get('/message/{room_id}',[MessageHandleController::class, 'getText']);
    Route::post('/message/{room_id}',[MessageHandleController::class, 'postText']);
});
