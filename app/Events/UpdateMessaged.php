<?php

namespace App\Events;

use App\Models\Message;
use App\Models\RoomUser;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UpdateMessaged implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $message;
    private $room_user;
    private $data;
    /**
     * Create a new event instance.
     */
    public function __construct(Message $msg, RoomUser $room_user)
    {
        $this->message = $msg;
        $this->room_user = $room_user;

        $this->data = $this->message
            ->select('messages.id', 'messages.room_id', 'messages.user_id', 'messages.sent_time', 'messages.content', 'users.name')
            ->join('users', 'users.id', '=', 'messages.user_id')
            ->where(['messages.id' => $msg->id])
            ->get()->first()->toArray();
    }

    /**
     *
     * Get the channels the event should broadcast on.
     * @return array<int, \Illuminate\Broadcasting\Channel> 
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('room_users-' . $this->room_user->room_id),
        ];
    }

    /**
     * Get the data to broadcast.
     *
     * @return array<string, mixed>
     */
    public function broadcastWith(): array
    {
        return [$this->data];
    }
}
