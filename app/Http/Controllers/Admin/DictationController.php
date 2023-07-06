<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\Admin\Dictation\StoreDictationRequest;
use App\Http\Requests\Admin\Dictation\UpdateDictationRequest;
use App\Http\Requests\Admin\Dictation\IndexDictationRequest;
use App\Services\Admin\DictationService;
use App\Http\Resources\Dictation\DictationResource;
use App\Http\Resources\Dictation\DictationCollection;
use App\Models\Dictation;
use Exception;


class DictationController extends Controller
{
    private $dictationService;

    public function __construct(DictationService $dictationService)
    {
        $this->dictationService = $dictationService;
    }

    public function index(IndexDictationRequest $request)
    { 
        $validData = $request->validated();

        $dictations = $this->dictationService->getAll($validData);
        $dictations->appends($validData);

        return view('admin.dictation.index', [
            'dictations' => new DictationCollection($dictations)
        ]);
    }

    public function autoCompleteSearch(Request $request)
    {
        return response()->json(
            $this->dictationService->getResultsAutoCompleteSearch($request->input('q'))
        );
    }

    public function store(StoreDictationRequest $request)
    {
        try{
            $validData = $request->validated();
            $this->dictationService->create($validData);

            return back()->with('message', 'Запись успешно добавлена')
                ->setStatusCode(Response::HTTP_CREATED);
        }catch(Exception $exp){
            return back()->with('error', 'Ошибка при добавлении записи')
                ->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function edit(Dictation $dictation)
    {
        return view('admin.dictation.edit', [
            'dictation' => new DictationResource($dictation)
        ]);
    }

    public function update(UpdateDictationRequest $request, Dictation $dictation)
    {
        try{
            $validData = $request->validated();
            $this->dictationService->update($dictation, $validData);

            return back()->with('message', 'Запись успешно обновлена')
                    ->setStatusCode(Response::HTTP_OK);
        }catch(Exception $exp){
            return back()->with('error', 'Ошибка при обновлении записи')
                ->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function delete(Dictation $dictation)
    {
        try{
            $this->dictationService->delete($dictation);
            
            return back()->with('message', 'Запись успешно удалена')
                ->setStatusCode(Response::HTTP_OK);
        }catch(Exception $exception){
            return back()->with('error', 'Ошибка при удалении записи')
                ->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
