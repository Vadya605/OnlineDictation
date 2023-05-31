<?php

namespace App\Services;

use App\Repositories\DictationRepository;

class DictationService{

    /**
     * @var DictationRepository
    */
    private $dictationRepository;

    /**
     * @param DictationRepository $dictationRepository
    */
    public function __construct(DictationRepository $dictationRepository){
        $this->dictationRepository = $dictationRepository;
    }
    /**
     * @return String
    */
    public function getAll(){
        return $this->dictationRepository->getAllDictation();
    }

    public function create($data){
        return $this->dictationRepository->createDictation($data);
    }

    public function update($data, $id){
        return $this->dictationRepository->updateDictation($data, $id);
    }

    public function delete($id){
        return $this->dictationRepository->deleteDictation($id);
    }
    
}
