<?php

namespace App\Services\Admin;

use App\Repositories\Dictation\DictationRepository;
use App\Models\Dictation;
use App\Events\Dictation\DictationAnswerUpdated;

class DictationService
{
    private $dictationRepository;

    public function __construct(DictationRepository $dictationRepository)
    {
        $this->dictationRepository = $dictationRepository;
    }
    
    public function getAll($outputValues=[])
    {
        return $this->dictationRepository->getAllDictation($outputValues);
    }

    public function getCount()
    {
        return $this->dictationRepository->getCountDictation();
    }

    public function getActive()
    {
        return $this->dictationRepository->getActiveDictation();
    }

    public function getResultsAutoCompleteSearch($searchValue=null)
    {
        return $this->dictationRepository->getResultsAutoCompleteSearch($searchValue);
    }

    public function getByChunk(callable $callback)
    {
        return $this->dictationRepository->getDictationsByChunk($callback);
    }

    public function getBySlug($id)
    {
        return $this->dictationRepository->getDictationBySlug($id);
    }

    public function create($data)
    {
        return $this->dictationRepository->createDictation($data);
    }

    public function update(Dictation $dictation, $changeDictationData)
    {
        $updatedDictation = $this->dictationRepository->updateDictation($dictation, $changeDictationData);

        if($this->dictationRepository->isDictationAnswerUpdated($updatedDictation)){
            event(new DictationAnswerUpdated($updatedDictation));
        }

        return $updatedDictation;
    }

    public function delete(Dictation $dictation)
    {
        return $this->dictationRepository->deleteDictation($dictation);
    }
}
