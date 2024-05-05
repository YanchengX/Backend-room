<?php

namespace App\Http\Middleware;

use App\Models\RoomUser;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserInRoom
{
    private $room_uesr;
    private $user;

    public function __construct(RoomUser $room_user, Auth $user)
    {
        $this->room_uesr = $room_user;
        $this->user = $user;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $room_id = $request->route('room_id');
        $status = $this->room_uesr->where('room_id', $room_id)->where('user_id', $this->user::id())->get();
        //collection
        if ($status->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'youre not the user in this room'
            ]); //exception
        }

        return $next($request);
    }
}
