<?php

namespace App\Repositorires;

use App\Models\User;

class UserRepository{
    
    private $user;
    
    public function __construct(User $user)
    {
        $this->user = $user;
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
}