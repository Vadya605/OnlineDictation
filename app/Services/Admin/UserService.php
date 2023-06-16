<?php

namespace App\Services\Admin;


use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAll($columnSort, $optionSort)
    {
        return $this->userRepository->getAllUser($columnSort, $optionSort);
    }

    public function getById($id)
    {
        return $this->userRepository->getUserById($id);
    }

    public function delete(User $user)
    {
        return $this->userRepository->deleteUser($user);
    }
}