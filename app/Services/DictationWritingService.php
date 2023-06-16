<?php

namespace App\Services;

use App\Repositories\Dictation\DictationRepository;
use App\Repositories\DictationResult\DictationResultRepository;
use Carbon\Carbon;
use Auth;

class DictationWritingService
{
    private $dictationRepository;
    private $dictationResultRepository;

    public function __construct(DictationRepository $dictationRepository, DictationResultRepository $dictationResultRepository)
    {
        $this->dictationRepository = $dictationRepository;
        $this->dictationResultRepository = $dictationResultRepository;
    }
    
    public function getActive()
    {
        $dictationsUser = Auth::user()->dictations;
        $activeDictation = $this->dictationRepository->getActiveDictation();
        
        if($dictationsUser->contains($activeDictation)){
            return;
        }

        return $activeDictation;
    }

    public function save($dictationResultData)
    {
        return $this->dictationResultRepository->saveDictationResult($dictationResultData);
    }
}
