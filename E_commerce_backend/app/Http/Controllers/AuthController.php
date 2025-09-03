<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Services\AuthService;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    
    function signup(StoreUserRequest $request){

        $user = $this->authService->registerUser($request->validated());
        
        return response()->json(compact('user'));
    }

    function login(LoginRequest $request){


       $data = $request->validated(); 
         return $this->authService->loginUser($data);

    }
    function logout(Request $request){

        $request->user()->currentAccessToken()->delete();
        
        return response()->json([
            "message"=>"user logut sucessfull"
    ],200);

    }
   
}
