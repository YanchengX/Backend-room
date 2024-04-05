<?php

namespace App\Http\Controllers\Room;

use App\Http\Controllers\Controller;
use App\Http\Requests\Room\RoomCreateRequest;
use App\Http\Requests\Room\RoomUpdateRequest;
use App\Models\Room;
use App\Repositories\RoomRepository;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    private Room $room;
    private RoomRepository $roomRepo;

    public function __construct(
        Room $room,
        RoomRepository $roomRepository
    ) {
        $this->room = $room;
        $this->roomRepo = $roomRepository;
    }

    public function index()
    {
        $data = $this->room->all();
        return $data;
    }

    public function show($id)
    {
        return [$this->room->find($id)];
    }

    public function create(RoomCreateRequest $request)
    {
        $data = $request->all();

        return [$this->room->create($data)];
    }

    public function update(RoomUpdateRequest $request, $id)
    {
        //undo
    }

    public function destroy($id)
    {
        return [$this->room->find($id)->delete()];
    }

    // need custom request to avoid query injection
    public function getFilterRoom(Request $request)
    {
        if ($request->all()) {
            $page = $request->get('page');
            $query = $request->get('query');
            $data = $this->roomRepo->getFilterRoom($page, $query);
            return $data;
        }
        return [];
    }

    public function getRoomCount(Request $request)
    {
        if ($request->all()) {
            $query = $request->get('query');
            $data = $this->roomRepo->getRoomCount($query);
            return $data;
        }
        return [];
    }
}
