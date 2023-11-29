<?php

namespace App\Http\Controllers\Message;

use App\Http\Controllers\FormatController;
use App\Http\Requests\Message\PostTextRequest;
use App\Models\Message;

class MessageHandleController extends FormatController
{
    private $message;
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function getText($room_id)
    {
        $msg = $this->message->where(['room_id'=>$room_id])->get();
        
        return [$msg];
    }

    public function postText(PostTextRequest $request, $room_id)
    {   
        $data = ["room_id" => $room_id];
        $data += $request->all();
        $data['sent_time'] = now();
        $model = $this->message->create($data);

        return [$model];
    }
}