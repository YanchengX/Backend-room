<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UserLoginRequest;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    public function login(UserLoginRequest $request)
    {
        $credentials = $request->all();
        if(! $token = Auth::attempt($credentials)){
            return response()->json([
                'error code' => 1,
            ],401);
        }
        
        return response()->json([
            'error code' => 0,
            'jwt' => $token,
        ],200);
    }
    
    public function logout()
    {
        Auth::logout();
        return response()->json([
            'error code' => 0
        ],200);
    }

    public function refresh()
    {
        return $this->respondWithToken(Auth::refresh());
    }

    
}
