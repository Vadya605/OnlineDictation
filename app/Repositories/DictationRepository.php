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
        $newDictation = new $this->dictation;
        $newDictation->fill([
            'title' => $data['title'],
            'video_link' => $data['video_link'],
            'is_active' => $data['is_active'],
            'description' => $data['description'],
            'start_date_time' => $data['start_date_time'],
            'end_date_time' => $data['end_date_time'],
        ]);
        $newDictation->save();
        return $newDictation->fresh();
    }

    public function updateDictation($data, $id){
        $dictationChange = $this->dictation
            ->where('id', $id)
            ->update($data);
        return $dictationChange;
    }

    public function deleteDictation($id){
        return $this->dictation->destroy($id);
    }
    
}
