<?php
namespace App\Http\Services;

use App\Http\Repositories\AuthRepository; 
use Illuminate\Support\Facades\Hash;


class AuthService
{

    protected $authRepository;
    function __construct(AuthRepository $authRepository){
        $this->authRepository=$authRepository;

    }
    public function registerUser($data){
        
        return $this->authRepository->createUser($data);
        
    }
    public function loginUser($data){

   
        $user=$this->authRepository->getUserByName($data['name']);

        if(!$user || !Hash::check($data['password'],$user->password)){
            return response()->json(
                ["message"=>"user not found"],404
        );

        }

        return response()->json([
            "user"=>$user,
            "token"=>$user->createToken($user->name)->plainTextToken
        ]);

    }
   

    public function logoutUser(){

    }

}