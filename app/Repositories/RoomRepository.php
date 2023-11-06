<?php

namespace App\Repositorires;

use App\Models\Room;

class RoomRepository{
    
    private $room;
    
    public function __construct(Room $room)
    {
        $this->room = $room;
    }
    
    public function getKey($id)
    {
        return $this->room->find($id)->key;
    }

    public function getAllRoom()
    {
        return $this->room->all();
    }

    public function getTargetRoom($id)
    {
        return $this->room->find($id);
    }
    
    public function createRoom($data)
    {
        $room = $this->room->create($data);
        return $room;
    }

    public function updateRoom($data, $id)
    {
        $room = $this->room->find($id);
        $room['name'] = $data['name'];
        $room['key'] = $data['key'];
        $room['owner'] = $data['owner'];
        
        return $room->save();
    }

    public function destroyRoom($id)
    {
        return $this->room->find($id)->delete();
    }
}