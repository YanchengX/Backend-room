<?php

namespace Tests\Feature\Auth;

use Database\Seeders\UserTableSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserLogoutTest extends TestCase
{
    use RefreshDatabase;

    private $url = 'api/user/logout';

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(UserTableSeeder::class);
        
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
