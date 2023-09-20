<?php

namespace App\Http\Controllers\Room;

use App\Http\Controllers\Controller;
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

        return response()->json([
            $room->key
        ]);
    }

    public function userJoin(Request $request, $id)
    {
        $room_id = $id;
        $user_id = $request->get('user_id');
        
        $model = $this->room_user->create(['room_id' => $room_id, 'user_id' => $user_id]);

        return response()->json([
            $model
        ]);
    }
    
    public function userLeft(Request $request, $id)
    {
        $room_id = $id;
        $user_id = $request->get('user_id');
        $model = $this->room_user->where(['room_id'=>$room_id, 'user_id'=>$user_id])->delete();

        return response()->json([
            $model
        ]);
    }
    
    public function userkick()
    {

    }

}
