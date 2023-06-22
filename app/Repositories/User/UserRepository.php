<?php

namespace App\Repositories\User;

use Illuminate\Database\Eloquent\Builder;
use App\Models\User;

class UserRepository
{
    public function getAllUser($outputValues)
    {
        return User::orderBy($outputValues['column_sort'], $outputValues['option_sort'])
            ->whereRaw("{$outputValues['column_filter']} {$outputValues['option_filter']} {$outputValues['value_filter']}")
            ->when($outputValues['search_value'], function (Builder $query, $searchValue) {
                $query->where('name', 'like', '%'.$searchValue.'%')
                        ->orWhere('email', 'like', '%'.$searchValue.'%')
                        ->orWhereRaw("DATE_FORMAT(created_at, '%Y-%m-%d %H:%i:%s') LIKE ?", ['%'.$searchValue.'%']);
            })
            ->paginate(10);

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

    public function updateUser(User $user, $userData)
    {
        $user->fill($userData);
        $user->save();

        return $user;
    }

    public function deleteUser(User $user)
    {
        return $user->delete();
    }
}
