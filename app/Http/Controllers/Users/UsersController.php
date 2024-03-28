<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Users\UsersService;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class UsersController extends Controller
{
    protected $usersService;

    public function __construct(UsersService $usersService)
    {
        $this->usersService = $usersService;
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = User::find(Auth::id());
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            $accessToken = $token->accessToken;

            return response()->json(['token' => $accessToken]);

        } else {
            return response()->json([
                'message' => 'Unauthorized',
            ], 401);
        }
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
