<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\Admin\User\GetAllUserRequest;
use App\Http\Requests\Admin\User\StoreUserRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;
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

    public function index(GetAllUserRequest $request)
    {
        try{
            $request->validated();
            $validData = $request->mergeDafault();
    
            return view('admin.user.allUser', ['users' => new UserCollection(
                $this->userService->getAll($validData)
            )]);
        }catch(Exception $exp){
            return back()->with('error', 'Ошибка при применении фильтров или поиска, проверьте параметры')
                ->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function create()
    {
        return view('admin.user.createUser');
    }

    public function store(StoreUserRequest $request)
    {
        try{
            $validData = $request->validated();
            $this->userService->create($validData);

            return back()->with('message', 'Запись успешно добавлена')
                ->setStatusCode(Response::HTTP_CREATED);
        }catch(Exception $exp){
            return back()->with('error', 'Ошибка при добавлении записи')
                ->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
    public function edit(User $user)
    {
        return view('admin.user.editUser', ['user' => new UserResource(
            $user
        )]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        try{
            $validData = $request->validated();
            $this->userService->update($user, $validData);

            return back()->with('message', 'Запись успешно обновлена')
                ->setStatusCode(Response::HTTP_OK);
        }catch(Exception $exp){
            return back()->with('error', 'Ошибка при добавлении записи')
                ->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function delete(User $user)
    {
        try{
            if($user->id == auth()->id()){
                return back()->with('error', 'Вы не можете удалить себя')
                    ->setStatusCode(Response::HTTP_FORBIDDEN);
            }
            $this->userService->delete($user);
    
            return back()->with('message', 'Запись успешно удалена')
                ->setStatusCode(Response::HTTP_OK);
        }catch(Exception $exp){
            return back()->with('error', 'Ошибка при удалении записи')
                ->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    
    
}
