<?php

namespace App\Services\Admin;

use App\Repositories\DictationResult\DictationResultRepository;

class DictationResultService
{
    private $dictationResultRepository;

    public function __construct(DictationResultRepository $dictationResultRepository)
    {
        $this->dictationResultRepository = $dictationResultRepository;
    }
    
    public function getAll($columnSort, $optionSort)
    {
        return $this->dictationResultRepository->getAllDictationResults($columnSort, $optionSort);
    }

    public function getById($id)
    {
        return $this->dictationResultRepository->getDictationResultById($id);
    }

    public function delete($id)
    {
        return $this->dictationResultRepository->deleteDictationResult($id);
    }
}
