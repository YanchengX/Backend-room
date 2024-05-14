<?php

namespace Tests\Feature\Room;

use App\Models\Room;
use Database\Seeders\RoomTableSeeder;
use Database\Seeders\UserTableSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoomControllerTest extends TestCase
{
    use RefreshDatabase;

    private $url = 'api/room';
    private $room;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(UserTableSeeder::class);
        $this->seed(RoomTableSeeder::class);

        $this->withHeaders([
            'Authorization' => $this->generateToken()
        ]);

        $this->room = [
            'name' => 'ajgjef',
            'key' => 'asdfasdf',
            'owner' => "1",
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

        $response = $this->post($this->url, $this->room);

        $response->assertOk();
    }

    // public function testUpdatePass()
    // {
    //     $data = [
    //         'name' => 'asdfsadfasdf',
    //         'key' => 'asdasd'
    //     ];
    //     $room = Room::where('name', '=', 'ajgjef')->first();
    //     $response = $this->patch($this->url.'/'.$room['id'], $data);

    //     $response->assertOk();
    // }

    public function testDestroyPass()
    {

        $this->post($this->url, $this->room);

        $room = Room::where('name', '=', 'ajgjef')->first();
        $response = $this->delete($this->url . '/' . $room['id']);

        $response->assertOk();
    }

    public function testGetFilterRoomPass()
    {
    }

    public function testGetRoomCountPass()
    {
    }

    public function testGetRoomCountTotalPass()
    {
    }
}
