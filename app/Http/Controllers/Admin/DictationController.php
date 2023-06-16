<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\Admin\Dictation\StoreDictationRequest;
use App\Http\Requests\Admin\Dictation\UpdateDictationRequest;
use App\Http\Requests\Admin\Dictation\GetAllDictationRequest;
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

    public function index(GetAllDictationRequest $request)
    { 
        $outputValues = [
            'column_sort' => $request->input('column_sort', 'id'),
            'option_sort' => $request->input('option_sort', 'asc'),
            'column_filter' => $request->input('column_filter', 'id'),
            'option_filter' => $request->input('option_filter', '>'),
            'value_filter' => $request->input('value_filter', '1'),
        ];

        return view('admin.dictation.allDictation', ['dictations' => new DictationCollection(
            $this->dictationService->getAll($outputValues)
        )]);
    }

    public function create()
    {
        return view('admin.dictation.createDictation');
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
        return view('admin.dictation.editDictation', ['dictation' => new DictationResource(
            $dictation
        )]);
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
}
