<?php

namespace App\Http\Repositories;
use App\Models\User;

class UserRepository
{

    public function createUser($data): User
    {
        return User::create($data);

    }
    public function getUserByName($name): User|null
    {
        return $user = User::where('name', $name)->first();
    }
    public function getUserbyEmail()
    {

    }
    public function countUser(): int
    {
        return User::count();
    }

}