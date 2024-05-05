<?php

namespace App\Broadcasting;

use App\Models\RoomUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Message
{
    private $room_user;
    private $user;
    /**
     * Create a new channel instance.
     */
    public function __construct(RoomUser $room_user, User $user)
    {
        $this->$room_user = $room_user;
        $this->$user = $user;
    }

    /**
     * Authenticate the user's access to the channel.
     */
    public function join(): array|bool
    {
        return Auth::check() && $this->user->id == Auth::id();
    }
}
