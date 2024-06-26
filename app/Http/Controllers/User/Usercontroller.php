<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserCreateRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;

class Usercontroller extends Controller
{
    private $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        return [$this->user->all()];
    }

    public function show($id)
    {
        return [$this->user->find($id)];
    }

    public function create(UserCreateRequest $request)
    {
        $data = $request->all();
        $this->user->create([
            'name' => $data['name'],
            'password' => $data['password'],
            'logged_ip' => ''
        ]);
        return ['status' => 'success'];
    }

    public function update(UserUpdateRequest $request, $id)
    {
        $user = $this->user->find($id);
        $data = $request->all();
        $user['name'] = $data['name'];
        $user['password'] = $data['password'];
        $user->save();

        return ['status' => 'success'];
    }

    public function destroy($id)
    {
        $this->user->find($id)->delete();
        return ['status' => 'success'];
    }
}
