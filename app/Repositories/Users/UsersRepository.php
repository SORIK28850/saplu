<?php

namespace App\Repositories\Users;
use App\Models\User;

class UsersRepository
{
    public function getUsers()
    {
        return User::all();
    }

    public function getUserById($id)
    {
        return User::find($id);
    }

    public function createUser($request)
    {
        return User::create($request);
    }

    public function updateUser(array $request)
    {
        $user = User::find($request['id']);
        $user->update($request);
        
        return $user;
    }

    public function deleteUser($id)
    {
        return User::destroy($id);
    }
    
}