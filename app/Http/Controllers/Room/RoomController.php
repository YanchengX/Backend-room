<?php

namespace App\Http\Controllers\Room;

use App\Http\Controllers\Controller;
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

        return response()->json([
            $this->room->all()
        ]);
    }

    public function show($id){
        
        return response()->json([
           $this->room->find($id)
        ]);
    }

    public function create(Request $request){
        $data = $request->all();
        
        return response()->json([
           $this->room->create($data), 
        ]);
    }

    public function update(Request $request, $id){
        
    }

    public function destroy($id){
        
        return response()->json([
            $this->room->find($id)->delete()
        ]);
    }
}
