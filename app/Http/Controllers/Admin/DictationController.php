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

        if($request->ajax()){
            return response()->json([
                'html' => view('admin.dictation.table', [
                    'dictations' => DictationResource::collection($dictations)
                    ])->render(),
                'total' => $dictations->total()
            ], Response::HTTP_OK);
        }

        return view('admin.dictation.index', [
            'dictations' => DictationResource::collection($dictations)
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

            return response()->json('Запись успешно добавлена', Response::HTTP_CREATED);
        }catch(Exception $exp){
            return response()->json('Ошибка при добавлении записи', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function edit(Dictation $dictation)
    {
        return response()->json(new DictationResource($dictation), Response::HTTP_OK);
    }

    public function update(UpdateDictationRequest $request, Dictation $dictation)
    {
        try{
            $validData = $request->validated();
            $this->dictationService->update($dictation, $validData);

            return response()->json('Запись успешно обновлена', Response::HTTP_OK);
        }catch(Exception $exp){
            return response()->json('Ошибка при обновлении записи', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function delete(Dictation $dictation)
    {
        try{
            $this->dictationService->delete($dictation);

            return response()->json('Запись успешно удалена', Response::HTTP_OK);
        }catch(Exception $exception){
            return response()->json('Ошибка при удалении записи', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
