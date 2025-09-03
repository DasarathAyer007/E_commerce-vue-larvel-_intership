<?php

namespace App\Http\Repositories;
use App\Models\User;

class AuthRepository
{

    public function createUser($data){
        return User::create($data);

    }
    public function getUserByName($name){
       return $user=User::where('name',$name)->first();
    }
    public function getUserbyEmail(){

    }
}