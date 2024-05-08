<?php

namespace Tests\Feature\User;

use App\Models\User;
use Database\Seeders\UserTableSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    private $url = 'api/user';
    private $user;
    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(UserTableSeeder::class);

        $this->withHeaders([
            'Authorization' => $this->generateToken()
        ]);

        $this->user = [
            'name' => 'ajgjef',
            'password' => 'asdfasdf'
        ];
    }

    public function testIndexPass()
    {
        $response = $this->get($this->url);

        $response->assertOk();
    }

    public function testShowPass()
    {
        $response = $this->get($this->url . '/1');

        $response->assertOk();
    }

    public function testCreatePass()
    {
        $response = $this->post($this->url, $this->user);

        $response->assertOk();
    }

    public function testUpdatePass()
    {

        $this->post($this->url, $this->user);
        $data = [
            'name' => 'asdfsadfasdf',
            'password' => 'asdasd'
        ];

        $user = User::where('name', '=', $this->user['name'])->first();

        $response = $this->put($this->url . '/' . $user['id'], $data);

        $response->assertOk();
    }

    public function testDestroyPass()
    {
        $this->post($this->url, $this->user);

        $user = User::where('name', '=', $this->user['name'])->first();

        $response = $this->delete($this->url . '/' . $user['id']);

        $response->assertOk();
    }
}
