<?php

namespace App\Repositories;

use App\Models\Dictation;

class DictationRepository{

    /**
     * @var Dictation
    */
    private $dictation;

    /**
     * @param Dictation $dictaion
    */
    public function __construct(Dictation $dictation){
        $this->dictation = $dictation;
    }
    /**
     * @return Dictation $dictaion
    */
    public function getAllDictation(){
        return $this->dictation->get();
    }

    public function createDictation($data){
        $newDictation = $this->dictation->create($data);
        return $newDictation;
    }

    public function updateDictation($data, $id){
        $dictationChange = $this->dictation
            ->where('id', $id)
            ->first()
            ->fill($data);
        $dictationChange->save();
        return $dictationChange;
    }

    public function deleteDictation($id){
        return $this->dictation->destroy($id);
    }
    
}
