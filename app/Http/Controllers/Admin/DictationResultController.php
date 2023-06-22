<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\Admin\DictationResult\GetAllDictationResultRequest;
use App\Http\Requests\Admin\DictationResult\UpdateDictationResultRequest;
use App\Http\Requests\Admin\DictationResult\StoreDictationResultRequest;
use App\Http\Resources\DictationResult\DictationResultResource;
use App\Http\Resources\DictationResult\DictationResultCollection;
use App\Services\Admin\DictationResultService;
use App\Models\DictationResult;
use Exception;

class DictationResultController extends Controller
{
    private $dictationResultService;

    public function __construct(DictationResultService $dictationResultService)
    {
        $this->dictationResultService = $dictationResultService;
    }

    public function index(GetAllDictationResultRequest $request)
    {
        try{
            $request->validated();
            $validData = $request->mergeDafault();
    
            return view('admin.dictationResult.allDictationResult', ['dictationResults' => new DictationResultCollection(
                $this->dictationResultService->getAll($validData)
            )]);
        }catch(Exception $exp){
            return back()->with('error', 'Ошибка при применении фильтров или поиска, проверьте параметры')
                ->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function create()
    {
        return view('admin.dictationResult.createDictationResult');
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
        return view('admin.dictationResult.editDictationResult', ['dictationResult' => 
            new DictationResultResource($dictationResult)
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
            
            return back()->with('message', 'Запись успешно обновлена')
                ->setStatusCode(Response::HTTP_OK);
        }catch(Exception $exp){
            return back()->with('error', 'Ошибка при удалении записи')
                ->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
