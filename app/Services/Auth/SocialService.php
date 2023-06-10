<?php

namespace App\Services\Auth;

use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Enums\User\UserRole;

class SocialService
{
    private $userRepository;

    private $userRole;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    
    public function save($userSocialite)
    {
        $userSocialiteData = [
            'name' => $userSocialite->getName(), 
            'password' => Hash::make($userSocialite->getId()),
            'email' => null,
            'vk_id' => $userSocialite->getId(),
            'role' => UserRole::USER
        ];

        $existingUser = $this->userRepository->getUserByVkId($userSocialiteData['vk_id']);

        if(!$existingUser){
            return $this->userRepository->createUser($userSocialiteData);
        }
        
        return $existingUser;
    }
    
    
}
