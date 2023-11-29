<?php

namespace App\Http\Controllers\Room;

use App\Http\Controllers\Controller;
use App\Http\Requests\Room\RoomCreateRequest;
use App\Http\Requests\Room\RoomUpdateRequest;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    private $room;
    
    public function __construct(Room $room)
    {
        $this->room = $room;
    }
    
    public function index(){
        return [$this->room->all()];
    }

    public function show($id){
        return [$this->room->find($id)];
    }

    public function create(RoomCreateRequest $request){
        $data = $request->all();
        
        return [$this->room->create($data)];
    }

    public function update(RoomUpdateRequest $request, $id){
        
    }

    public function destroy($id){
        return [$this->room->find($id)->delete()];
    }
}
