<?php
namespace App\Http\Services;

use App\Http\Repositories\UserRepository; 
use Illuminate\Support\Facades\Hash;


class UserService
{

    protected $userRepository;
    function __construct(UserRepository $userRepository){
        $this->userRepository=$userRepository;

    }
    public function registerUser($data){
        
        return $this->userRepository->createUser($data);
        
    }
    public function loginUser($data){

   
        $user=$this->userRepository->getUserByName($data['name']);

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

    public function getTotalUser(){
        return $this->userRepository->countUser();
    }

}