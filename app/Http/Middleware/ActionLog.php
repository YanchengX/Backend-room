<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class ActionLog
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
    }

    /**
     * Make Aciton Log for store user call Api infomation
     * @param Request
     * @param Response
     */
    public function terminate(Request $request, Response $response): void
    {
        $info = [
            'RequestMethod' => $request->method(),
            'RequestPath' => $request->path(),
            'Client Response Status' => $response->getStatusCode()
        ];
        Log::info($info);
    }
}
