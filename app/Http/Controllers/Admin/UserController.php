<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\Admin\User\IndexUserRequest;
use App\Http\Requests\Admin\User\StoreUserRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\Services\Admin\UserService;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Exception;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(IndexUserRequest $request)
    {        
        $validData = $request->validated();
    
        $users = $this->userService->getAll($validData);
        $users->appends($validData);

        if($request->ajax()){
            return response()->json([
                'html' => view('admin.user.table', [
                    'users' => UserResource::collection($users)
                    ])->render(),
                'total' => $users->total()
            ], Response::HTTP_OK);
        }

        return view('admin.user.index', [
            'users' => UserResource::collection($users),
        ]);
    }

    public function autoCompleteSearch(Request $request)
    {
        $searchValue = $request->input('q');

        return response()->json(
            $this->userService->getResultsAutoCompleteSearch($searchValue)
        );
    }

    public function store(StoreUserRequest $request)
    {
        try{
            $validData = $request->validated();
            $this->userService->create($validData);

            return response()->json('Запись успешно добавлена', Response::HTTP_CREATED);
        }catch(Exception $exp){
            return response()->json('Ошибка при добавлении записи', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
    public function edit(User $user)
    {
        return view('admin.user.edit', [
            'user' => new UserResource($user)
        ]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        try{
            $validData = $request->validated();
            $this->userService->update($user, $validData);

            return response()->json('Запись успешно обновлена', Response::HTTP_OK);
        }catch(Exception $exp){
            return response()->json('Ошибка при удалении записи', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function delete(User $user)
    {
        try{
            if($user->id == auth()->id()){
                return response()->json('Вы не можете удалить себя', Response::HTTP_FORBIDDEN);
            }
            $this->userService->delete($user);

            return response()->json('Запись успешно удалена', Response::HTTP_OK);
        }catch(Exception $exp){
            return response()->json('Ошибка при удалении записи', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    } 
}
