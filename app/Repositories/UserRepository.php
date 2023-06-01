<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository{

    /**
     * @var user
    */
    private $user;

    /**
     * @param User $user
    */
    public function __construct(User $user){
        $this->user = $user;
    }

    public function getUserByEmail($userEmail){
        return $this->user->where('email', $userEmail)->first();
    }
    
    public function createUser($userData){
        $user = $this->user->create($userData);
        return $user;
    }

    public function updateUser($newUserData, $userId){
        $user = $this->user->where('id', $userId)->first()->fill($newUserData);
        $user->save();
        return $user;
    }
    
    
}
