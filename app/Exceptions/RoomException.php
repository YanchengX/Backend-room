<?php

namespace App\Exceptions;

class RoomException implements ExceptionMethod
{
    public function throwAuthFailedException()
    {
        throw new ApiException(
            401,
            'auth failed', //to be use in trans setting
            101 // to be use in config setting
        );
    }
}
