<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        if (!$user = Auth::user()) {
            return response()->json([
                'message' => 'identify unauthenticated'
            ]);
        }
        return $next($request);
    }
}
