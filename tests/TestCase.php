<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function generateToken()
    {
        $token = $this->post('api/user/login',[
            'name' => 'abcd',
            'password' => 'fuck'
        ]);
        return $token['jwt'];
    }
}
