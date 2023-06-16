<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\Admin\DictationResult\GetDictationResultRequest;
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

    public function index(GetDictationResultRequest $request)
    {
        $request->validated();
        $columnSort = $request->input('column_sort', 'id');
        $optionSort = $request->input('option_sort', 'asc');

        return view('admin.dictationResult.allDictationResult', ['dictationResults' => new DictationResultCollection(
            $this->dictationResultService->getAll($columnSort, $optionSort)
        )]);
    }

    public function show(DictationResult $dictationResult)
    {
        return view('admin.dictationResult.showDictationResult', ['dictationResult' => new DictationResultResource(
            $dictationResult
        )]);
    }

    public function delete(DictationResult $dictationResult)
    {
        try{
            $this->dictationResultService->delete($dictationResult);
            
            return redirect()->route('allDictationResults');
        }catch(Exception $exp){
            return back()->with('error', 'Ошибка при удалении записи')
                ->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
