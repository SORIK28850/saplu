<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Users\UsersService;

class UsersController extends Controller
{
    protected $usersService;

    public function __construct(UsersService $usersService)
    {
        $this->usersService = $usersService;
    }

    public function index()
    {
        return $this->usersService->getUsers();
    }

    public function getById(Request $request)
    {
        return $this->usersService->getUserById($request->id);
    }

    public function create(Request $request)
    {
        return $this->usersService->createUser($request->all());
    }

    public function update(Request $request)
    {
        return $this->usersService->updateUser($request->all());
    }

    public function delete(Request $request)
    {
        return $this->usersService->deleteUser($request->id);
    }

}
