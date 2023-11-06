<?php

namespace App\Http\Controllers\Message;

use App\Http\Controllers\Controller;
use App\Http\Requests\Message\PostTextRequest;
use App\Models\Message;

class MessageHandleController extends Controller
{
    private $message;
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function getText($room_id)
    {
        $msg = $this->message->where(['room_id'=>$room_id])->get();
        
        return response()->json([
            $msg
        ]);
    }

    public function postText(PostTextRequest $request, $room_id)
    {   
        $data = ["room_id" => $room_id];
        $data += $request->all();
        $data['sent_time'] = now();
        $model = $this->message->create($data);

        return response()->json([
            $model
        ]);
    }
}