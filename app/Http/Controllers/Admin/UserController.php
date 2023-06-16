<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\Admin\User\GetUserRequest;
use App\Http\Requests\Admin\User\StoreUserRequest;
use App\Services\Admin\UserService;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\User\UserCollection;
use App\Models\User;
use Exception;


class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(GetUserRequest $request)
    {
        $request->validated();
        $columnSort = $request->input('column_sort', 'id');
        $optionSort = $request->input('option_sort', 'asc');

        return view('admin.user.allUser', ['users' => new UserCollection(
            $this->userService->getAll($columnSort, $optionSort)
        )]);
    }

    public function show(User $user)
    {
        return view('admin.user.showUser', ['user' => new UserResource(
            $user
        )]);
    }

    public function delete(User $user)
    {
        try{
            $this->userService->delete($user);
    
            return redirect()->route('allUsers');
        }catch(Exception $exp){
            return back()->with('error', 'Ошибка при удалении записи')
                ->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    
    
}
