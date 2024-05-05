<?php

namespace App\Events;

use App\Models\RoomUser;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserJoin implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $room_user;

    /**
     * Create a new event instance.
     */
    public function __construct(RoomUser $room_user)
    {
        $this->room_user = $room_user;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('room_users.' . $this->room_user->room_id),
        ];
    }

    public function broadcasWith(): array
    {
        return [
            'data' => $this->room_user,
            'message' => $this->room_user->user_id . 'is join',
        ];
    }
}
