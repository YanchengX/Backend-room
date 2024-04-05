<?php

namespace App\Repositories;

use App\Models\Room;

class RoomRepository
{

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

    public function getFilterRoom($currentPage, $query)
    {
        $itemPerPage = 3;
        $offset = ($currentPage - 1) * $itemPerPage;

        $result = $this->room->select('id', 'name')
            ->where('id', 'LIKE', "%$query%")
            ->orWhere('name', 'LIKE', "%$query%")
            ->orderBy('id')
            ->LIMIT("$itemPerPage")
            ->OFFSET($offset)
            ->get();
        return $result;
    }
    public function getRoomCount($query)
    {
        $itemPerPage = 3;
        $result = $this->room->select(\DB::raw("COUNT(*)"))
            ->where('id', 'LIKE', "%$query%")
            ->orWhere('name', 'LIKE', "%$query%")
            ->get();
        $page = ceil($result[0]["COUNT(*)"] / $itemPerPage);

        return $page;
    }
}