<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
class Authenticate extends Middleware
{
    // override unathenticated parent method to avoid using redirectTo
    protected function unauthenticated($request, array $guards)
    {
        //block requirement and return error for request any guarded api;
        return;
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    // protected function redirectTo(Request $request): ?string
    // {
    //     return $request->expectsJson() ? null : ('/');
    // }
}
