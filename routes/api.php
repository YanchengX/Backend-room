<?php

use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\HealthController;
use App\Http\Controllers\Message\MessageHandleController;
use App\Http\Controllers\Room\RoomController;
use App\Http\Controllers\Room\RoomHandleController;
use App\Http\Controllers\User\Usercontroller;
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

Route::get('/health', HealthController::class);

Route::group(['middleware' => ['action.log']], function () {

    Route::post('/user/login', [UserAuthController::class, 'login']);
    Route::post('/user', [Usercontroller::class, 'create']); //register
});

Route::group(['middleware' => ['auth:api']], function () {

    Route::post('/user/logout', [UserAuthController::class, 'logout']);
    Route::get('/user/refresh', [UserAuthController::class, 'refresh']);
    //user
    Route::get('/user', [Usercontroller::class, 'index']);
    Route::get('/user/{id}', [Usercontroller::class, 'show']);
    Route::put('/user/{id}', [Usercontroller::class, 'update']);
    Route::delete('/user/{id}', [Usercontroller::class, 'destroy']);

    //user handle for statistic
    Route::get('/users/totalOnline', [Usercontroller::class, 'getAllOnlineUser']);
    Route::get('/users/getCreateRecently', [Usercontroller::class, 'getUserCreatedRecently']);
    Route::get('/users/getPerUserInfo', [Usercontroller::class, 'getPerUserInfo']);

    //room
    Route::get('/room', [RoomController::class, 'index']);
    Route::get('/room/{id}', [RoomController::class, 'show']);
    Route::post('/room', [RoomController::class, 'create']);

    //filter and roomCount and seperate from {id} handle
    Route::get('/rooms/search', [RoomController::class, 'getFilterRoom']);
    Route::get('/rooms/pagination', [RoomController::class, 'getRoomCount']);
    Route::get('/rooms/roomTotalCount', [RoomController::class, 'getRoomCountTotal']);

    //room handle
    Route::post('/rooms/join', [RoomHandleController::class, 'userJoin']);

    //msg handle and room auth handle
    Route::get('/rooms/getUser/{id}', [RoomHandleController::class, 'getRoomUser']);

    Route::group(['middleware' => ['userIn']], function () {
        Route::get('/message/{room_id}', [MessageHandleController::class, 'getText']);
        Route::post('/message/{room_id}', [MessageHandleController::class, 'postText']);
        Route::patch('/room/{id}', [RoomController::class, 'update']);
        Route::delete('/room/{id}', [RoomController::class, 'destroy']);
        Route::post('/rooms/left/{id}', [RoomHandleController::class, 'userLeft']);
    });
});
