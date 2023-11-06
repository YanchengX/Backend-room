<?php

namespace App\Repositorires;

use App\Models\Message;

class MessageRepository{
    
    private $message;
    
    public function __construct(Message $message)
    {
        $this->message = $message;
    }
    
    public function getText($room_id)
    {
        return $this->message->where(['room_id'=>$room_id])->get();
    }

    public function postText($data, $room_id)
    {
        $data = ["room_id" => $room_id];
        $data += $data;
        $data['sent_time'] = now();
        return $this->message->create($data);
    }

}