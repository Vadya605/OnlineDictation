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
        // $users->appends($validData);

        if($request->ajax()){
            return view('admin.user.table', [
                'users' => UserResource::collection($users)
            ]);
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

            return back()->with('message', 'Запись успешно добавлена')
                ->setStatusCode(Response::HTTP_CREATED);
        }catch(Exception $exp){
            return back()->with('error', 'Ошибка при добавлении записи')
                ->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
    public function edit(User $user)
    {
        return view('admin.user.edit', ['user' => 
            new UserResource($user)
        ]);
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
