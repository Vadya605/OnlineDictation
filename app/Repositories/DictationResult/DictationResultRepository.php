<?php

namespace App\Repositories\DictationResult;

use App\Models\DictationResult;
use Illuminate\Database\Eloquent\Builder;

class DictationResultRepository
{
    public function getAllDictationResults($outputValues)
    {
        return DictationResult::orderBy($outputValues['column_sort'], $outputValues['option_sort'])
                ->where($outputValues['column_filter'], $outputValues['option_filter'], $outputValues['value_filter'])
                ->when($outputValues['search_value'], function (Builder $query, $searchValue) {
                        $query->where('users.name', 'like', '%'.$searchValue.'%')
                            ->orWhere('dictations.title', 'like', '%'.$searchValue.'%')
                            ->orWhereRaw("DATE_FORMAT(dictation_results.date_time_result, '%Y-%m-%d %H:%i:%s') LIKE ?", ['%'.$searchValue.'%']);
                })
                ->join('users', 'dictation_results.user_id', '=', 'users.id')
                ->join('dictations', 'dictation_results.dictation_id', '=', 'dictations.id')
                ->select('dictation_results.*', 'users.name', 'users.email', 'dictations.title')
                ->paginate(10);
    }

    public function getDictationResultById($id)
    {
        return DictationResult::find($id);
    }

    public function createDictationResult($dictationResultData)
    {
        $newDictationResult = new DictationResult;

        $newDictationResult->text_result = $dictationResultData['text_result'];
        $newDictationResult->dictation_id = $dictationResultData['dictation_id'];
        $newDictationResult->user_id = $dictationResultData['user_id'];
        $newDictationResult->date_time_result = $dictationResultData['date_time_result'];
        $newDictationResult->save();

        return $newDictationResult;
    }

    public function updateDictationResult(DictationResult $dictationResult, $dictationResultData)
    {
        $dictationResult->fill($dictationResultData);
        $dictationResult->save();

        return $dictationResult;
    }

    public function deleteDictationResult($dictationResult)
    {
        return $dictationResult->delete();
    }
}
