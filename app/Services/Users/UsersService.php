<?php

namespace App\Services\Users;

use App\Repositories\Users\UsersRepository;

class UsersService
{
    protected $usersRepository;

    public function __construct(UsersRepository $usersRepository)
    {
        $this->usersRepository = $usersRepository;
    }

    public function getUsers()
    {
        return $this->usersRepository->getUsers();
    }

    public function getUserById($id)
    {
        return $this->usersRepository->getUserById($id);
    }

    public function createUser(array $request)
    {
        return $this->usersRepository->createUser($request);
    }

    public function updateUser(array $data)
    {
        return $this->usersRepository->updateUser($data);
    }

    public function deleteUser($id)
    {
        return $this->usersRepository->deleteUser($id);
    }

}