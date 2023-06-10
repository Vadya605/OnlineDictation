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

    public function updateUser($userData, $userId)
    {
        $changedUser = User::where('id', $userId)
            ->first()   
            ->fill($userData);

        $changedUser->save();

        return $changedUser;
    }

    public function deleteUser($id)
    {
        return User::destroy($id);
    }
}
