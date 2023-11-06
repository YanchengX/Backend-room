<?php

namespace App\Repositorires;

use App\Models\RoomUser;

class RoomUserRepository{
    
    private $room_user;
    
    public function __construct(RoomUser $roomUser)
    {
        $this->room_user = $roomUser;
    }
    
    public function userJoin($data)
    {
        $room = $this->room_user->find($data['room_id']);
        if($room['key'] != $data['key']){
            return false;
        }
        $status = $this->room_user->create(
            ['room_id' => $data['room_id'],'user_id' => $data['user_id']]
        );

        return $status;
    }

    public function userLeft($user_id, $room_id)
    {
        return $this->room_user->where(['room_id'=>$room_id, 'user_id'=>$user_id])->delete();
    }
    
    public function userKick()
    {

    }
}