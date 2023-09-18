<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    
    public function login(Request $request)
    {
        $data = $request->all();
        
        if(Auth::attempt($data)){
            $request->session()->regenerate();
        }
        $user = Auth::user();

        return response()->json([
            'id' => $user,
        ]);
    }
    

    public function logout(Request $request)
    {

    }
}
