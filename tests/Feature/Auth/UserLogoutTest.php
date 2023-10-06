<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserLogoutTest extends TestCase
{
    private $url = 'api/user/logout';
    private $user;
    protected function setUp(): void
    {
        parent::setUp();
        $this->user = [
            'name' => 'abc',
            'password' => 'fuck'
        ];
        $this->withHeaders([
            'Authorization' => $this->generateToken()
        ]);
    }

    public function testLogoutPass()
    {
        $response = $this->post($this->url);
        
        $response->assertOk();
    }
}
