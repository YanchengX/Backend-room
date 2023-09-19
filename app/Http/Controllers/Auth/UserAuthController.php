<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    
    public function login(Request $request)
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
    
    public function logout(Request $request)
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
