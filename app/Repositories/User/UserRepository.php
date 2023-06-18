<?php

namespace App\Repositories\User;

use App\Models\User;

class UserRepository
{
    public function getAllUser($columnSort, $optionSort)
    {
        return User::orderBy($columnSort, $optionSort)->paginate(1);
    }

    public function getUserById($id)
    {
        return User::find($id);
    }

    public function getUserByVkId($userVkId)
    {
        return User::where('vk_id', $userVkId)->first();
    }
    
    public function createUser($userData)
    {
        $newUser = new User;
        $newUser->name = $userData['name'];
        $newUser->email = $userData['email'];
        $newUser->password = $userData['password'];
        $newUser->role = $userData['role'];
        $newUser->vk_id = $userData['vk_id'];
        $newUser->save();

        return $newUser;
    }

    public function deleteUser(User $user)
    {
        return $user->delete();
    }
}
