<?php

namespace App\Repositories\DictationResult;

use App\Models\DictationResult;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Carbon\Carbon;

class DictationResultRepository
{
    public function getAllDictationResults($outputValues=[])
    {
        $dictationResults = DictationResult::query()
                ->join('users', 'dictation_results.user_id', '=', 'users.id')
                ->join('dictations', 'dictation_results.dictation_id', '=', 'dictations.id')
                ->select('dictation_results.*', 'users.name', 'users.email', 'dictations.title')
                ->whereNull('dictations.deleted_at');

        if($sort = Arr::get($outputValues, 'sort')){
            $sortParams = config("params.sort.dictationResults.{$sort}");
            $sortColumn = Arr::get($sortParams, 'sort_column');
            $sortOption = Arr::get($sortParams, 'sort_option');

            $dictationResults->orderBy($sortColumn, $sortOption);
        }

        if($dictationId = Arr::get($outputValues, 'dictation')){
            $dictationResults->where('dictations.id', '=', $dictationId);
        }

        if($userId = Arr::get($outputValues, 'user')){
            $dictationResults->where('users.id', '=', $userId);
        }

        if($fromDateTime = Arr::get($outputValues, 'date_from')){
            $dictationResults->where('dictation_results.date_time_result', '>=', Carbon::parse($fromDateTime)->format('Y-m-d H:i:s'));
        }

        if($toDateTime = Arr::get($outputValues, 'date_to')){
            $dictationResults->where('dictation_results.date_time_result', '<=', Carbon::parse($toDateTime)->format('Y-m-d H:i:s'));
        }

        return $dictationResults->paginate(10);
    }

    public function getCountDictationResult()
    {
        return DictationResult::count();
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
        $newDictationResult->date_time_result = Carbon::parse($dictationResultData['date_time_result'])->format('Y-m-d H:i:s');
        $newDictationResult->save();

        return $newDictationResult;
    }

    public function updateDictationResult(DictationResult $dictationResult, $dictationResultData)
    {
        $dictationResultData['date_time_result'] = Carbon::parse($dictationResultData['date_time_result'])->format('Y-m-d H:i:s');

        $dictationResult->fill($dictationResultData);
        $dictationResult->save();

        return $dictationResult;
    }

    public function deleteDictationResult($dictationResult)
    {
        return $dictationResult->delete();
    }
}
