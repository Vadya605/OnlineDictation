<?php

namespace App\Services\Admin;

use App\Repositories\DictationResult\DictationResultRepository;
use App\Models\DictationResult;

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
