<?php

namespace App\Services\Admin;

use App\Repositories\DictationResult\DictationResultRepository;
use App\Models\DictationResult;
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

    public function isCorrect(DictationResult $dictationResult)
    {
        return $dictationResult->text_result === $dictationResult->dictation->answer;
    }

    public function checkResults(Collection $dictationResults)
    {
        foreach($dictationResults as $dictationResult){
            if(!$dictationResult->is_checked){
                $this->update($dictationResult, [
                    'is_checked' => true,
                    'mark' => $this->isCorrect($dictationResult) ? 10 : 2
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
