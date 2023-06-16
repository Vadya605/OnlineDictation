<?php

namespace App\Repositories\Dictation;

use App\Models\Dictation;
use Carbon\Carbon;

class DictationRepository
{
    public function getAllDictation($outputValues)
    {
        return Dictation::orderBy($outputValues['column_sort'], $outputValues['option_sort'])
            ->where($outputValues['column_filter'], $outputValues['option_filter'], $outputValues['value_filter'])
            ->paginate(2);
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

    public function updateDictation(Dictation $dictation, $changeDictationData)
    {  
        $dictation->fill($changeDictationData);
        $dictation->save();

        return $dictation;
    }
}
