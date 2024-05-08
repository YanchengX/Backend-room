<?php

namespace App\Http\Controllers\Message;

use App\Events\UpdateMessaged;
use App\Http\Controllers\FormatController;
use App\Http\Requests\Message\PostTextRequest;
use App\Models\Message;
use App\Models\RoomUser;
use Illuminate\Support\Facades\Auth;

class MessageHandleController extends FormatController
{
    private $message;
    private $user;
    private $room_user;

    public function __construct(Message $message, Auth $user, RoomUser $room_user)
    {
        $this->message = $message;
        $this->user = $user;
        $this->room_user = $room_user;
    }

    public function getText($room_id)
    {
        // select message all and user name by user_id
        $msg = $this->message
            ->select('messages.id', 'messages.room_id', 'messages.user_id', 'messages.sent_time', 'messages.content', 'users.name')
            ->join('users', 'users.id', '=', 'messages.user_id')
            ->where(['room_id' => $room_id])
            ->get();

        return ['EventCode' => 1, 'data' => $msg];
    }

    public function postText(PostTextRequest $request, $room_id)
    {
        $data = ["room_id" => $room_id];
        $data['content'] = $request->get('content');
        $data['user_id'] = $request->get('user_id');
        $data['sent_time'] = Date(now());

        //create msg and join to get user name
        $messageModel = $this->message->create($data);
        $room_userModel = $this->room_user  //get room user model to check who is it
            ->where('room_id', $room_id)
            ->where('user_id', $data['user_id'])
            ->get()->first();

        event(new UpdateMessaged($messageModel, $room_userModel));

        return ['EventCode' => 1];
    }
}
