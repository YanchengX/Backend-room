<?php

namespace App\Repositories;

use App\Models\RoomUser;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class RoomUserRepository
{

    private $room_user;
    private $user;

    public function __construct(RoomUser $roomUser,  User $user)
    {
        $this->room_user = $roomUser;
        $this->user = $user;
    }

    public function userJoin($data)
    {
        $room = $this->room_user->find($data['room_id']);
        if ($room['key'] != $data['key']) {
            return false;
        }
        $status = $this->room_user->create(
            ['room_id' => $data['room_id'], 'user_id' => $data['user_id']]
        );

        return $status;
    }

    public function userLeft($user_id, $room_id)
    {
        return $this->room_user->where(['room_id' => $room_id, 'user_id' => $user_id])->delete();
    }

    public function userKick()
    {
    }

    public function getUserList($room_id)
    {
        $userList = DB::table('room_users')
            ->leftJoin('users', 'room_users.user_id', '=', 'users.id')
            ->select('user_id', 'name')
            ->where('room_id', '=', $room_id)
            ->get();
        return $userList;
    }
}
