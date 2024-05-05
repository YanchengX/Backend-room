<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\FormatController;
use App\Http\Requests\Auth\UserLoginRequest;
use App\Exceptions\ExceptionMethod;
use App\Exceptions\RoomException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class UserAuthController extends FormatController
{
    private ExceptionMethod $exception;
    private Auth $user;
    private Redis $memo;

    public function __construct(
        RoomException $exception,
        Auth $user,
        Redis $memo
    ) {
        $this->user = $user;
        $this->exception =  $exception;
        $this->memo = $memo;
    }

    public function login(UserLoginRequest $request)
    {
        $credentials = $request->all();
        if (!$token = $this->user::attempt($credentials)) {
            $this->exception->throwAuthFailedException();
        }
        $this->memo::set($this->user::id(), True, 'EX', 3600); //follow jwt exp time

        return ['jwt' => "$token"];
    }

    public function logout()
    {
        $this->memo::del($this->user::id());
        $this->user::logout();

        return ['EventCode' => 1];
    }

    public function refresh()
    {
        $this->memo::set($this->user::id(), True, 'EX', 3600);
        $refreshToken = ($this->user::refresh());
        return ['refreshToken' => $refreshToken];
    }
}
