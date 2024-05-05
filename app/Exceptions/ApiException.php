<?php

namespace App\Exceptions;


use Symfony\Component\HttpKernel\Exception\HttpException;

class ApiException extends HttpException
{
    private $statusCode;
    public function __construct(int $statusCode, string $message, int $code)
    {
        $this->statusCode = $statusCode;
        parent::__construct($statusCode, $message, null, [], $code);
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}
