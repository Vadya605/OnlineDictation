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

    public function deleteDictationResult($dictationResult)
    {
        return $dictationResult->delete();
    }
}
