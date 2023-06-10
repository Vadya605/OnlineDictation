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

    public function show($id)
    {
        return view('admin.user.showUser', ['user' => new UserResource(
            $this->userService->getById($id)
        )]);
    }

    public function delete(Request $request)
    {
        $this->userService->delete($request->id);

        return redirect()->route('allUsers');
    }

    
    
}
