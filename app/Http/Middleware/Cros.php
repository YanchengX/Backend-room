<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Cros
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $request->header('Access-Control-Allow-Origin', '*');
        header('Access-Control-Allow-Origin', "*");
        header('Access-Control-Allow-Headers:  Content-Type, application/json, Authorization, Origin');
        header('Access-Control-Allow-Methods:  POST, PUT');

        return $next($request);
    }
}
