<?php

namespace App\Repositories\DictationResult;

use App\Models\DictationResult;

class DictationResultRepository
{
    public function getAllDictationResults($columnSort, $optionSort)
    {
        return DictationResult::orderBy($columnSort, $optionSort)->paginate(2);
    }

    public function getDictationResultById($id)
    {
        return DictationResult::find($id);
    }

    public function saveDictationResult($dictationResultData)
    {
        $newDictationResult = new DictationResult;

        $newDictationResult->text_result = $dictationResultData['text_result'];
        $newDictationResult->dictation_id = $dictationResultData['dictation_id'];
        $newDictationResult->user_id = $dictationResultData['user_id'];
        $newDictationResult->date = $dictationResultData['date'];
        $newDictationResult->save();

        return $newDictationResult;
    }

    public function deleteDictationResult($dictationResult)
    {
        return $dictationResult->delete();
    }
}
