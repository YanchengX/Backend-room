<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Redis;

class UserRepository
{

    private $user;
    private $memo;

    public function __construct(User $user, Redis $memo)
    {
        $this->user = $user;
        $this->memo = $memo;
    }

    public function getAllUser()
    {
        return $this->user->all();
    }

    public function getTargetUser($id)
    {
        return $this->user->find($id);
    }

    public function createUser($data)
    {
        $user = $this->user->create([
            'name' => $data['name'],
            'password' => $data['password'],
        ]);
        return $user;
    }

    public function updateUser($data, $id)
    {
        $user = $this->user->find($id);
        $user['name'] = $data['name'];
        $user['password'] = $data['password'];

        return $user->save();
    }

    public function destroyUser($id)
    {
        return $this->user->find($id)->delete();
    }

    public function getUserCreatedRecently()
    {
        $now = time() - 604800; // a week
        $date = date('Y-m-d H:i:s', $now); //convert type
        $data = $this->user->where('created_at', '>', $date)->get();

        return count($data);
    }

    public function getPerUserInfo()
    {
        $user = $this->user->select('id', 'name')
            ->get();

        $result = array();
        foreach ($user as $value) {
            $status = $this->memo::get($value->id);
            array_push($result, ['id' => $value->id, 'name' => $value->name, 'status' => $status]);
        };

        return $result;
    }
}
