<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\Admin\DictationResult\IndexDictationResultRequest;
use App\Http\Requests\Admin\DictationResult\UpdateDictationResultRequest;
use App\Http\Requests\Admin\DictationResult\StoreDictationResultRequest;
use App\Http\Resources\DictationResult\DictationResultResource;
use App\Http\Resources\DictationResult\DictationResultCollection;
use App\Http\Resources\Dictation\DictationCollection;
use App\Http\Resources\User\UserCollection;
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
        $request->validated();
        $validData = $request->validated();

        $dictationResults = $this->dictationResultService->getAll($validData);
        
        $dictationResults->appends($validData);

        return view('admin.dictationResult.index', [
            'dictationResults' => new DictationResultCollection($dictationResults),
            'dictations' => new DictationCollection($this->dictationService->getResultsAutoCompleteSearch()),
            'users' => new UserCollection($this->userService->getResultsAutoCompleteSearch())
        ]);
    }

    public function store(StoreDictationResultRequest $request)
    {
        try{
            $validData = $request->validated();
            $this->dictationResultService->create($validData);

            return back()->with('message', 'Запись успешно добавлена')
                ->setStatusCode(Response::HTTP_CREATED);
        }catch(Exception $exp){
            return back()->with('error', 'Ошибка при добавлении записи')
                ->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function edit(DictationResult $dictationResult)
    {
        return view('admin.dictationResult.edit', [
            'dictationResult' => new DictationResultResource($dictationResult),
            'dictations' => new DictationCollection($this->dictationService->getResultsAutoCompleteSearch()),
            'users' => new UserCollection($this->userService->getResultsAutoCompleteSearch())
        ]);
    }

    public function update(UpdateDictationResultRequest $request, DictationResult $dictationResult)
    {
        try{
            $validData = $request->validated();
            $this->dictationResultService->update($dictationResult, $validData);

            return back()->with('message', 'Запись успешно обновлена')
                ->setStatusCode(Response::HTTP_OK);
        }catch(Exception $exp){
            return back()->with('error', $exp->getMessage())
                ->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function delete(DictationResult $dictationResult)
    {
        try{
            $this->dictationResultService->delete($dictationResult);
            
            return back()->with('message', 'Запись успешно удалена')
                ->setStatusCode(Response::HTTP_OK);
        }catch(Exception $exp){
            return back()->with('error', 'Ошибка при удалении записи')
                ->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
