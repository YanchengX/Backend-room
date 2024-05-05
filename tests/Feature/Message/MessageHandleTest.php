<?php

namespace Tests\Feature\Message;

use Database\Seeders\MessageTableSeeder;
use Database\Seeders\UserTableSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MessageHandleTest extends TestCase
{
    use RefreshDatabase;
    
    private $url = 'api/message/1';
    
    protected function setUp(): void
    {   
        parent::setUp();
        $this->seed(UserTableSeeder::class);
        $this->seed(MessageTableSeeder::class);

        $this->withHeaders([
            'Authorization' => $this->generateToken()
        ]);
    }
    
    public function testGetTextPass()
    {
        $response = $this->get($this->url);
        
        $response->assertOk();
    }

    public function testPostTextPass()
    {
        $msg = [
            'user_id' => 1,
            'content' => 'testContent',
        ];

        $response = $this->post($this->url, $msg);

        $response->assertOk();
    }
}
