<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DictationWritingService;
use App\Http\Resources\Dictation\DictationResource;
use App\Http\Requests\StoreDictationResultRequest;
use Illuminate\Http\Response;
use Exception;

class DictationWritingController extends Controller
{
    private $dictationWritingService;

    public function __construct(DictationWritingService $dictationWritingService)
    {
        $this->dictationWritingService = $dictationWritingService;
    }

    public function index(Request $request)
    {
        $activeDictation = $this->dictationWritingService->getActive();
        if(!$activeDictation){
            return view('dictationWriting', ['activeDictation' => null]);
        }

        return view('dictationWriting', ['activeDictation' => new DictationResource(
            $activeDictation
        )]);
    }

    public function store(StoreDictationResultRequest $request)
    {
        try{
            $validData = $request->validated();
            $this->dictationWritingService->save($validData);

            return response()->json('Результат сохранен', Response::HTTP_CREATED);
        }catch(Exception $exp){
            return response()->json($exp->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
