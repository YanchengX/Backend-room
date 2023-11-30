<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Make standard json response 
     */
    public function render($request, Throwable $e)
    {
        //factory render chooce witch exception..
        //category by exception-structure or api request route ->
        
        //by request route
        if( $request->is('api/*') ){
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                'exceptionCode' =>$e->getCode(),
            ]);          
        }

        //category by exception attribute
        // if ($e instanceof HttpException){
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => $e->getMessage(),
        //         'exceptionCode' =>$e->getCode(),
        //     ]);
        // }

    }
}