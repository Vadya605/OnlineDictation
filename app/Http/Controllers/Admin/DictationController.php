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


class DictationController extends Controller
{
    private $dictationService;

    public function __construct(DictationService $dictationService)
    {
        $this->dictationService = $dictationService;
    }

    public function index(GetAllDictationRequest $request)
    { 
        $request->validated();
        $columnSort = $request->input('column_sort', 'id');
        $optionSort = $request->input('option_sort', 'asc');

        return view('admin.dictation.allDictation', ['dictations' => new DictationCollection(
            $this->dictationService->getAll($columnSort, $optionSort)
        )]);
    }

    public function create()
    {
        return view('admin.dictation.createDictation');
    }

    public function store(StoreDictationRequest $request)
    {
        $validData = $request->validated();
        $this->dictationService->create($validData);

        return back()->with('message', 'Запись успешно добавлена')
                ->setStatusCode(Response::HTTP_CREATED);
    }

    public function edit($id)
    {
        return view('admin.dictation.editDictation', ['dictation' => new DictationResource(
            $this->dictationService->getById($id)
        )]);
    }

    public function update(UpdateDictationRequest $request)
    {
        $validData = $request->validated();
        $this->dictationService->update($validData);
        
        return back()->with('message', 'Запись успешно обновлена')
                ->setStatusCode(Response::HTTP_OK);
    }

    public function delete($id)
    {
        $this->dictationService->delete($id);

        return back()->with('message', 'Запись успешно удалена')
                ->setStatusCode(Response::HTTP_NO_CONTENT);
    }
}
