<?php

namespace App\Services\Admin;

use App\Repositories\Dictation\DictationRepository;
use App\Models\Dictation;

class DictationService
{
    private $dictationRepository;

    public function __construct(DictationRepository $dictationRepository)
    {
        $this->dictationRepository = $dictationRepository;
    }
    
    public function getAll($outputValues)
    {
        return $this->dictationRepository->getAllDictation($outputValues);
    }

    public function getById($id)
    {
        return $this->dictationRepository->getDictationById($id);
    }

    public function create($data)
    {
        return $this->dictationRepository->createDictation($data);
    }

    public function update(Dictation $dictation, $changeDictationData)
    {
        return $this->dictationRepository->updateDictation($dictation, $changeDictationData);
    }

    public function delete($id)
    {
        return $this->dictationRepository->deleteDictation($id);
    }
}
