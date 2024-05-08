<?php

namespace App\Http\Controllers\Room;

use App\Events\UserJoin;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FormatController;
use App\Http\Requests\Room\UserJoinRequest;
use App\Http\Requests\Room\UserLeftRequest;
use App\Models\Room;
use App\Models\RoomUser;
use App\Repositories\RoomUserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;

class RoomHandleController extends FormatController
{
    private $room;
    private $room_user;
    private $user;
    private $room_user_repo;

    public function __construct(
        Room $room,
        RoomUser $room_user,
        Auth $user,
        RoomUserRepository $room_user_repo
    ) {
        $this->room = $room;
        $this->room_user = $room_user;
        $this->user = $user;
        $this->room_user_repo = $room_user_repo;
    }

    /**
     * user_id room_id key
     */
    public function userJoin(UserJoinRequest $request)
    {

        $room_id = $request->collect('room_id');
        $user_id = $request->collect('user_id');
        $key = $request->collect('key');

        $room = $this->room->find($room_id)->first();
        $room_user = $this->room_user
            ->where('room_id', $room_id)
            ->where('user_id', $user_id)
            ->get();

        if (!$room_user->isEmpty()) {
            return ['EventCode' => 4]; //error handle, already join
        }
        if ($room->key != '' && $key[0] != $room->key) {
            return ['EventCode' => 3]; //error handle key wrong, when room is locked
        }

        $model = $this->room_user->create(['room_id' => intval($room_id[0]), 'user_id' => intval($user_id[0])]);

        event(new UserJoin($model));

        return ['EventCode' => 1];
    }

    public function userLeft(UserLeftRequest $request, $room_id)
    {
        $user_id = $request->get('user_id');
        $model = $this->room_user->where(['room_id' => $room_id, 'user_id' => $user_id])->delete();

        return ['EventCode' => 1];
    }

    public function userKick()
    {
        //TBI
    }

    public function getRoomUser(Request $request, $id)
    {
        return ['EventCode' => 1, 'data' => $this->room_user_repo->getUserList($id)];
    }

    public function roomOwnerChange()
    {
        //TBI
    }
}
