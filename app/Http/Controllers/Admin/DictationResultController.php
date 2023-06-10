<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\Admin\DictationResult\GetDictationResultRequest;
use App\Http\Resources\DictationResult\DictationResultResource;
use App\Http\Resources\DictationResult\DictationResultCollection;
use App\Services\Admin\DictationResultService;

class DictationResultController extends Controller
{
    private $dictationResultService;

    public function __construct(DictationResultService $dictationResultService)
    {
        $this->dictationResultService = $dictationResultService;
    }

    public function index(GetDictationResultRequest $request)
    {
        $request->validated();
        $columnSort = $request->input('column_sort', 'id');
        $optionSort = $request->input('option_sort', 'asc');

        return view('admin.dictationResult.allDictationResult', ['dictationResults' => new DictationResultCollection(
            $this->dictationResultService->getAll($columnSort, $optionSort)
        )]);
    }

    public function show(Request $request)
    {
        return view('admin.dictationResult.showDictationResult', ['dictationResult' => new DictationResultResource(
            $this->dictationResultService->getById($request->id)
        )]);
    }

    public function delete(Request $request)
    {
        $this->dictationResultService->delete($request->id);

        return redirect()->route('allDictationResults');
    }
}
