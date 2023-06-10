<?php

namespace App\Repositories\Dictation;

use App\Models\Dictation;

class DictationRepository
{
    public function getAllDictation($columnSort, $optionSort)
    {
        return Dictation::orderBy($columnSort, $optionSort)->paginate(2);
    }

    public function getDictationById($id)
    {
        return Dictation::find($id);
    }

    public function createDictation($dictationData)
    {
        $newDictation = new Dictation;

        $newDictation->title=$dictationData['title'];
        $newDictation->video_link=$dictationData['video_link'];
        $newDictation->is_active=$dictationData['is_active'];
        $newDictation->video_link=$dictationData['video_link'];
        $newDictation->description=$dictationData['description'];
        $newDictation->from_date_time=$dictationData['from_date_time'];
        $newDictation->to_date_time=$dictationData['to_date_time'];
        $newDictation->save();

        return $newDictation;
    }

    public function updateDictation($dictationData)
    {
        $changedDictation = Dictation::where('id', $dictationData['id'])
            ->first()
            ->fill($dictationData);
        
        $changedDictation->save();

        return $changedDictation;
    }

    public function deleteDictation($id)
    {
        return Dictation::destroy($id);
    } 
}
