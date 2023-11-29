<?php

namespace App\Http\Controllers\Room;

use App\Http\Controllers\Controller;
use App\Http\Requests\Room\UserJoinRequest;
use App\Http\Requests\Room\UserLeftRequest;
use App\Models\Room;
use App\Models\RoomUser;
use Illuminate\Http\Request;

class RoomHandleController extends Controller
{
    private $room;
    private $room_user;
    
    public function __construct(Room $room, RoomUser $room_user)
    {
        $this->room = $room;
        $this->room_user = $room_user;
    }

    public function getKey($id)
    {
        $room = $this->room->find($id);

        return [$room->key];
    }

    public function userJoin(UserJoinRequest $request)
    {
        $room_id = $request->get('room_id');
        $user_id = $request->get('user_id');
        $key = $request->get('key');
        $locate = $this->room->find($room_id);   
        if($key != $locate['key']){
            return ['key mismatch'];
        }

        $model = $this->room_user->create(['room_id' => $room_id, 'user_id' => $user_id]);
        return [$model];
    }
    
    public function userLeft(UserLeftRequest $request, $room_id)
    {
        $user_id = $request->get('user_id');
        $model = $this->room_user->where(['room_id'=>$room_id, 'user_id'=>$user_id])->delete();

        return [$model];
    }
    
    public function userKick()
    {
        //TBI
    }

}
