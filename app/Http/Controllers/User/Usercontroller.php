<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FormatController;
use App\Http\Requests\User\UserCreateRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class Usercontroller extends FormatController
{
    private $user;
    private $user_repo;
    private $memo;

    public function __construct(User $user, Redis $memo, UserRepository $user_repo)
    {
        $this->user = $user;
        $this->memo = $memo;
        $this->user_repo = $user_repo;
    }

    public function index()
    {
        return ['data' => $this->user->all()];
    }

    public function show($id)
    {
        return ['data' => $this->user->find($id)];
    }

    public function create(UserCreateRequest $request)
    {
        $data = $request->all();
        $this->user->create([
            'name' => $data['name'],
            'password' => $data['password'],
            'logged_ip' => ''
        ]);
        return ['EventCode' => 1];
    }

    public function update(UserUpdateRequest $request, $id)
    {
        $user = $this->user->find($id);
        $data = $request->all();
        $user['name'] = $data['name'];
        $user['password'] = $data['password'];
        $user->save();

        return ['EventCode' => 1];
    }

    public function destroy($id)
    {
        $this->user->find($id)->delete();
        return ['EventCode' => 1];
    }

    public function getAllOnlineUser(Request $request)
    {
        return ['data' => count($this->memo::keys("*"))];
    }

    public function getUserCreatedRecently(Request $request)
    {
        $count = $this->user_repo->getUserCreatedRecently();
        return ['data' => $count];
    }

    public function getPerUserInfo(Request $request)
    {
        return ['data' => $this->user_repo->getPerUserInfo()];
    }
}
