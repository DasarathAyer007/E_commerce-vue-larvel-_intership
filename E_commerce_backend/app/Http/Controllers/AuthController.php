<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Services\UserService;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;


class AuthController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    function signup(StoreUserRequest $request): JsonResponse
    {

        $user = $this->userService->registerUser($request->validated());

        return response()->json(compact('user'));
    }

    function login(LoginRequest $request): JsonResponse
    {

        $data = $request->validated();
        return $this->userService->loginUser($data);

    }
    function logout(Request $request): JsonResponse
    {

        $request->user()->currentAccessToken()->delete();

        return response()->json([
            "message" => "user logut sucessfull"
        ], 200);

    }

}
