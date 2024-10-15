<?php

namespace App\Http\Controllers\v1;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController
{
    private UserController $userController;
    public function __construct(UserController $userController) {
        $this->userController = $userController;
    }

    public function Register(StoreUserRequest $request) {
        $createdUser = $this->userController->store($request);
        return $createdUser;
    }


    public function Login(LoginUserRequest $request) {
        return User::attemptAuth($request);
    }


    public function Logout(Request $request) {

    }
}
