<?php

namespace App\Services\Auth;

use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Hash;
use App\Enums\User\UserRole;
use App\Models\User;

class RegisterService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function save($userData)
    {
        $userData['password'] = Hash::make($userData['password']);
        $userData['role'] = UserRole::USER;
        $userData['vk_id'] = null;
        
        return $this->userRepository->createUser($userData);
    }

    
}