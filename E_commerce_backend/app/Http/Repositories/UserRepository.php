<?php

namespace App\Http\Repositories;
use App\Models\User;

class UserRepository
{

    public function createUser($data){
        return User::create($data);

    }
    public function getUserByName($name){
       return $user=User::where('name',$name)->first();
    }
    public function getUserbyEmail(){

    }
    public function countUser(){
        return User::count();
    }
    
}