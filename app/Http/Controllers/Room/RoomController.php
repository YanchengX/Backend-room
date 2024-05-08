<?php

namespace App\Http\Controllers\Room;

use App\Http\Controllers\FormatController;
use App\Http\Requests\Room\RoomCreateRequest;
use App\Http\Requests\Room\RoomUpdateRequest;
use App\Models\Room;
use App\Models\RoomUser;
use App\Repositories\RoomRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomController extends FormatController
{
    private Room $room;
    private RoomRepository $roomRepo;
    private Auth $user;
    private RoomUser $room_user;

    public function __construct(
        Room $room,
        RoomRepository $roomRepository,
        RoomUser $room_user,
        Auth $user
    ) {
        $this->room = $room;
        $this->roomRepo = $roomRepository;
        $this->room_user = $room_user;
        $this->user = $user;
    }

    public function index()
    {
        $data = $this->room->all();
        return ['EventCode' => 1, 'data' => $data];
    }

    public function show($id)
    {
        return ['EventCode' => 1, 'data' => $this->room->find($id)];
    }

    // room name key owner
    public function create(RoomCreateRequest $request)
    {
        $data = $request->all();
        $newRoom = $this->room->create($data);
        $this->room_user->create(['room_id' => $newRoom->id, "user_id" => $data['owner']]);

        return ['EventCode' => 1, 'data' => $newRoom->id];
    }

    public function update(RoomUpdateRequest $request, $id)
    {
        $room = $this->room->find($id);
        if ($this->user->id() != $room['owner']) {
            return ['status', 'error']; //exception group
        }

        $data = $request->all();
        $room['name'] = $data['name'];
        $room['key'] = $data['key'];
        $room->save();

        return ['EventCode' => 1];
    }

    public function destroy($id)
    {
        $room = $this->room->find($id);
        if ($this->user->id() != $room['owner']) {
            return ['status', 'error']; //exception
        }

        return ['EventCode' => 1];
    }

    // need custom request to avoid query injection
    public function getFilterRoom(Request $request)
    {
        if ($request->all()) {
            $page = $request->get('page');
            $query = $request->get('query');
            $data = $this->roomRepo->getFilterRoom($page, $query);
            return ['data' => $data];
        }
        return ['EventCode' => 1];
    }

    public function getRoomCount(Request $request)
    {
        if ($request->all()) {
            $query = $request->get('query');
            $data = $this->roomRepo->getRoomCount($query);
            return ['data' => $data];
        }
        return ['EventCode' => 1];
    }

    public function getRoomCountTotal(Request $request)
    {
        $data = $this->roomRepo->getRoomCountTotal();

        return ['EventCode' => 1, 'data' => $data];
    }
}
