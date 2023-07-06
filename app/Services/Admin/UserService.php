<?php

namespace App\Services\Admin;


use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Hash;
use App\Enums\User\UserRole;
use App\Models\User;

class UserService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAll($outputValues=[])
    {
        return $this->userRepository->getAllUser($outputValues);
    }

    public function getResultsAutoCompleteSearch($searchValue=null)
    {
        return $this->userRepository->getResultsAutoCompleteSearch($searchValue);
    }

    public function getCount()
    {
        return $this->userRepository->getCountUser();
    }

    public function getById($id)
    {
        return $this->userRepository->getUserById($id);
    }

    public function create($userData)
    {
        $userData['vk_id'] = null;
        $userData['password'] = Hash::make('password');
        $userData['role'] = UserRole::USER;

        return $this->userRepository->createUser($userData);
    }

    public function update(User $user, $userData)
    {
        return $this->userRepository->updateUser($user, $userData);
    }

    public function delete(User $user)
    {
        return $this->userRepository->deleteUser($user);
    }
}