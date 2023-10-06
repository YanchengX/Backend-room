<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{

    private $url = 'api/user';
    protected function setUp(): void
    {
        parent::setUp();
        $this->withHeaders([
            'Authorization' => $this->generateToken()
        ]);
    }

    public function testIndexPass()
    {
        $response = $this->get($this->url);
        
        $response->assertOk();
    }

    public function testShowPass()
    {
        $response = $this->get($this->url.'/1');
        
        $response->assertOk();
    }

    public function testCreatePass()
    {   
        $user = [
            'name' => 'ajgjef',
            'password' => 'asdfasdf'
        ];

        $response = $this->post($this->url, $user);
        
        $response->assertOk();
    }

    public function testUpdatePass()
    {
        $data = [
            'name' => 'asdfsadfasdf',
            'password' => 'asdasd'
        ];
        $user = User::where('name', '=', 'ajgjef')->first();
        $response = $this->put($this->url.'/'.$user['id'], $data);
        
        $response->assertOk();
    }

    public function testDestroyPass()
    {
        $user = User::where('name', '=', 'asdfsadfasdf')->first();

        $response = $this->delete($this->url.'/'.$user['id']);
        
        $response->assertOk();
    }

}

