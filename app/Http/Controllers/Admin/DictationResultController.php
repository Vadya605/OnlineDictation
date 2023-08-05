<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\Admin\DictationResult\IndexDictationResultRequest;
use App\Http\Requests\Admin\DictationResult\UpdateDictationResultRequest;
use App\Http\Requests\Admin\DictationResult\StoreDictationResultRequest;
use App\Http\Resources\DictationResult\DictationResultResource;
use App\Http\Resources\Dictation\DictationResource;
use App\Http\Resources\User\UserResource;
use App\Services\Admin\DictationResultService;
use App\Services\Admin\DictationService;
use App\Services\Admin\UserService;
use App\Models\DictationResult;
use Exception;

class DictationResultController extends Controller
{
    private $dictationResultService;
    private $dictationService;
    private $userService;

    public function __construct(DictationResultService $dictationResultService, DictationService $dictationService, UserService $userService)
    {
        $this->dictationResultService = $dictationResultService;
        $this->dictationService = $dictationService;
        $this->userService = $userService;
    }

    public function index(IndexDictationResultRequest $request)
    {
        $validData = $request->validated();

        $dictationResults = $this->dictationResultService->getAll($validData);
        $dictationResults->appends($validData);

        if($request->ajax()){
            return view('admin.dictationResult.table', [
                'dictationResults' => DictationResultResource::collection($dictationResults)
            ]);
        }

        return view('admin.dictationResult.index', [
            'dictationResults' => DictationResultResource::collection($dictationResults),
            'dictations' => DictationResource::collection($this->dictationService->getResultsAutoCompleteSearch()),
            'users' => UserResource::collection($this->userService->getResultsAutoCompleteSearch())
        ]);
    }

    public function store(StoreDictationResultRequest $request)
    {
        try{
            $validData = $request->validated();
            $this->dictationResultService->create($validData);

            return response()->json('Запись успешно добавлена', Response::HTTP_CREATED);
        }catch(Exception $exp){
            return response()->json('Ошибка при добавлении записи', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function edit(DictationResult $dictationResult)
    {
        return response()->json(new DictationResultResource($dictationResult), Response::HTTP_OK);
    }

    public function update(UpdateDictationResultRequest $request, DictationResult $dictationResult)
    {
        try{
            $validData = $request->validated();
            $this->dictationResultService->update($dictationResult, $validData);

            return response()->json('Запись успешно обновлена', Response::HTTP_OK);

        }catch(Exception $exp){
            return response()->json('Ошибка при обновлении записи', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function delete(DictationResult $dictationResult)
    {
        try{
            $this->dictationResultService->delete($dictationResult);
            
            return response()->json('Запись успешно удалена', Response::HTTP_OK);

        }catch(Exception $exp){
            return response()->json('Ошибка при удалении записи', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
