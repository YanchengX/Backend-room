<?php

namespace Tests\Feature\Room;

use Database\Seeders\RoomTableSeeder;
use Database\Seeders\UserTableSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoomHandleTest extends TestCase
{
    use RefreshDatabase;

    private $url = 'api/room';

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(UserTableSeeder::class);
        $this->seed(RoomTableSeeder::class);

        $this->withHeaders([
            'Authorization' => $this->generateToken()
        ]);
    }

    public function testUserJoinPass()
    {
        $data = [
            'room_id' => '1',
            'user_id' => '1',
            'key' => 'yrevLuD2EJ'
        ];
        $response = $this->post($this->url . '/join', $data);

        $response->assertOk();
    }

    public function testUserLeftPass()
    {
        $room_id = 1;
        $data = [
            'user_id' => '1',
        ];
        $response = $this->post($this->url . '/left/' . $room_id, $data);

        $response->assertOk();
    }

    // public function testUserKickPass()
    // {

    // }
}
