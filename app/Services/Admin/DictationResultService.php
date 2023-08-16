<?php

namespace App\Services\Admin;

use App\Repositories\DictationResult\DictationResultRepository;
use App\Models\DictationResult;
use App\Models\Dictation;
use Illuminate\Database\Eloquent\Collection;

class DictationResultService
{
    private $dictationResultRepository;

    public function __construct(DictationResultRepository $dictationResultRepository)
    {
        $this->dictationResultRepository = $dictationResultRepository;
    }
    
    public function getAll($outputValues)
    {
        return $this->dictationResultRepository->getAllDictationResults($outputValues);
    }

    public function getCount()
    {
        return $this->dictationResultRepository->getCountDictationResult();
    }

    public function isCorrect(DictationResult $dictationResult, Dictation $dictation)
    {
        return $dictationResult->text_result === $dictation->answer;
    }

    public function checkResults(Collection $dictations)
    {
        $dictations = $dictations->filter(fn($dictation) => $dictation->results->count());

        foreach($dictations as $dictation){
            $checkableResults = $dictation->results->filter(fn($result) => !$result->is_checked);
    
            foreach($checkableResults as $checkableResult){
                $mark = $this->isCorrect($checkableResult, $dictation) ? 10 : 2;
    
                $this->dictationResultRepository->updateDictationResult($checkableResult, [
                    'is_checked' => true,
                    'mark' => $mark
                ]);
            }
        }
    }

    public function getById($id)
    {
        return $this->dictationResultRepository->getDictationResultById($id);
    }

    public function create($dictationResultData)
    {
        return $this->dictationResultRepository->createDictationResult($dictationResultData);
    }

    public function update(DictationResult $dictationResult, $dictationResultData)
    {
        return $this->dictationResultRepository->updateDictationResult($dictationResult, $dictationResultData);
    }

    public function delete(DictationResult $dictationResult)
    {
        return $this->dictationResultRepository->deleteDictationResult($dictationResult);
    }
}
