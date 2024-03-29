<?php

namespace App\Repositories\User;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use App\Models\User;
use Carbon\Carbon;

class UserRepository
{
    public function getAllUser($outputValues=[])
    {
        $users = User::query()
            ->orderBy('created_at', 'desc');

        if($sort = Arr::get($outputValues, 'sort')){
            $sortParams = config("params.sort.users.{$sort}");
            $sortColumn = Arr::get($sortParams, 'sort_column');
            $sortOption = Arr::get($sortParams, 'sort_option');

            $users->getQuery()->orders = null;
            $users->orderBy($sortColumn, $sortOption);
        }

        if($filter = Arr::get($outputValues, 'filter')){
            $filterParams = config("params.filter.users.{$filter}");
            $filterColumn = Arr::get($filterParams, 'filter_column');
            $filterOption = Arr::get($filterParams, 'filter_option');
            $filterValue = Arr::get($filterParams, 'filter_value');

            $users->where($filterColumn, $filterOption, $filterValue);
        }
        
        if($fromDateTime = Arr::get($outputValues, 'date_from')){
            $users->where('created_at', '>=', Carbon::parse($fromDateTime)->format('Y-m-d H:i:s'));
        }
        
        if($toDateTime = Arr::get($outputValues, 'date_to')){
            $users->where('created_at', '<=', Carbon::parse($toDateTime)->format('Y-m-d H:i:s'));
        }
        
        if($search = Arr::get($outputValues, 'search')){
            $users->where('name', 'like', '%'.$search.'%')
                ->orWhere('email', 'like', '%'.$search.'%');
        }
        
        return $users->paginate(10);

    }

    public function getResultsAutoCompleteSearch($searchValue=null)
    {
        return User::where('name', 'like', "%{$searchValue}%")->get();
    }

    public function getCountUser()
    {
        return User::count();
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
