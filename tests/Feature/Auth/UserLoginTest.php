<?php

namespace Tests\Feature\Auth;

use Database\Seeders\UserTableSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserLoginTest extends TestCase
{
    use RefreshDatabase;

    private $url = 'api/user/login';
    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(UserTableSeeder::class);
    }

    public function testLoginPass()
    {
        $user = [
            'name' => 'abcd',
            'password' => 'fuck'
        ];

        $response = $this->post($this->url, $user);

        $response->assertStatus(200);
        $this->assertNotEmpty(['jwt']);
    }

    /**
     * @dataProvider invalidInputProvider
     * 
     * @param array $user
     */
    public function testFailAuth(array $user)
    {
        $response = $this->post($this->url, $user);

        $response->assertUnauthorized();
    }

    /**
     * @return array 
     * ['name','password']
     */
    public static  function invalidInputProvider()
    {
        return [
            'incorrect info' => [
                [
                    'name' => 'abc',
                    'password' => 'a'
                ],
            ]
        ];
    }
}
