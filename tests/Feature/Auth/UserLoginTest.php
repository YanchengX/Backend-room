<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserLoginTest extends TestCase
{
    private $url = 'api/user/login';
    protected function setUp(): void
    {
        parent::setUp();
    }
    
    public function testloginPass()
    {
        $user = [
            'name' => 'abcd',
            'password' => 'fuck'
        ];
        
        $response = $this->post($this->url, $user);

        $response->assertStatus(200);
        $this->assertNotEmpty($response->decodeResponseJson()['jwt']);
    }

    // public function testValidationError($validate)
    // {
    //     $response = $this->post($this->url, $validate);

    //     dd($response);
    // }

    public function testFailAuth()
    {
        $user = [
            'name' => 'abc',
            'password' => 'a'
        ];

        $response = $this->post($this->url, $user);
        
        $response->assertUnauthorized();
    }

    public function invalidInput()
    {
        return[
            'no name' => [
                ['password' => '1234']
            ],
            'no pwd' => [
                ['name' => 'abc']
            ]
        ];
    }
}
