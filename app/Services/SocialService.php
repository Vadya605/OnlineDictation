<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class SocialService{

    /**
     * @var UserRepository
    */
    private $userRepository;

    /**
     * @param UserRepository $userRepository
    */
    public function __construct(UserRepository $userRepository){
        $this->userRepository = $userRepository;
    }
    
    public function save($userSocialite){
        $userSocialiteData = [
            'name' => $userSocialite->getName(), 
            'email' => $userSocialite->getEmail(), 
            'password' => Hash::make($userSocialite->id)
        ];

        $existingUser = $this->userRepository->getUserByEmail($userSocialite['email']);
        if($existingUser){
            return $this->userRepository->updateUser(
                ['name'=> $userSocialiteData['name']], 
                $existingUser->id
            );
        }
        
        return $this->userRepository->createUser($userSocialiteData);
    }
    
    
}
