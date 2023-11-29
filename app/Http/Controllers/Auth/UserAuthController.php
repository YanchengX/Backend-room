<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\FormatController;
use App\Http\Requests\Auth\UserLoginRequest;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends FormatController
{
    public function login(UserLoginRequest $request)
    {
        $credentials = $request->all();
        if(! $token = Auth::attempt($credentials)){
            return ['EventCode' => 1]; //TB exception handle
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
