<?php

namespace App\Exceptions;


use Symfony\Component\HttpKernel\Exception\HttpException;

class ApiException extends HttpException
{
    public function __construct(int $statusCode, string $message, int $code)
    {
        parent::__construct($statusCode, $message, null, [], $code);
    }
}