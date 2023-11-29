<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\FormatController;
use App\Http\Requests\Auth\UserLoginRequest;
use App\Exceptions\ExceptionMethod;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\RoomExeption;
class UserAuthController extends FormatController
{
    private ExceptionMethod $exception;

    public function __construct(
        RoomExeption $exception
        )
    {
        $this->exception =  $exception;
    }

    public function login(UserLoginRequest $request)
    {
        $credentials = $request->all();
        if(! $token = Auth::attempt($credentials)){
            $this->exception->throwAuthFailedException();
        }
        return ['EventCode' => 0, 'jwt' => $token];
    }

    public function logout()
    {
        Auth::logout();
        return ['EventCode' => 0];
    }

    public function refresh()
    {
        return $this->respondWithToken(Auth::refresh());
    }
}
