<?php

namespace Tests\Feature\Room;

use App\Models\Room;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoomControllerTest extends TestCase
{
    private $url = 'api/room';
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
        $room = [
            'name' => 'ajgjef',
            'key' => 'asdfasdf',
            'owner' => "1",
        ];

        $response = $this->post($this->url, $room);
        
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
        $room = Room::where('name', '=', 'ajgjef')->first();

        $response = $this->delete($this->url.'/'.$room['id']);
        
        $response->assertOk();
    }
}
