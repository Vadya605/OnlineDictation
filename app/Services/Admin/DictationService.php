<?php

namespace App\Services\Admin;

use App\Repositories\Dictation\DictationRepository;

class DictationService
{
    private $dictationRepository;

    public function __construct(DictationRepository $dictationRepository)
    {
        $this->dictationRepository = $dictationRepository;
    }
    
    public function getAll($columnSort, $optionSort)
    {
        return $this->dictationRepository->getAllDictation($columnSort, $optionSort);
    }

    public function getById($id)
    {
        return $this->dictationRepository->getDictationById($id);
    }

    public function create($data)
    {
        return $this->dictationRepository->createDictation($data);
    }

    public function update($data)
    {
        return $this->dictationRepository->updateDictation($data);
    }

    public function delete($id)
    {
        return $this->dictationRepository->deleteDictation($id);
    }
}
