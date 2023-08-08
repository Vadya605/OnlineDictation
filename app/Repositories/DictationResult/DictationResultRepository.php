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
            ->orderBy('created_at', 'desc')
            ->whereNull('dictations.deleted_at');

        if($sort = Arr::get($outputValues, 'sort')){
            $sortParams = config("params.sort.dictationResults.{$sort}");
            $sortColumn = Arr::get($sortParams, 'sort_column');
            $sortOption = Arr::get($sortParams, 'sort_option');

            $dictationResults->getQuery()->orders = null;
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

        $dateTimeResult = Carbon::parse(Arr::get($dictationResultData, 'date_time_result'))->format('Y-m-d H:i:s');

        $newDictationResult->text_result = Arr::get($dictationResultData, 'text_result');
        $newDictationResult->dictation_id = Arr::get($dictationResultData, 'dictation_id');
        $newDictationResult->user_id = Arr::get($dictationResultData, 'user_id');
        $newDictationResult->is_checked = Arr::get($dictationResultData, 'is_checked');
        $newDictationResult->mark = Arr::get($dictationResultData, 'mark');
        $newDictationResult->date_time_result = $dateTimeResult;

        $newDictationResult->save();

        return $newDictationResult;
    }

    public function updateDictationResult(DictationResult $dictationResult, $dictationResultData)
    {
        if($dateTimeResult = Arr::get($dictationResultData, 'date_time_result')){
            $dateTimeResult = Carbon::parse($dateTimeResult)->format('Y-m-d H:i:s');
            $dictationResultData['date_time_result'] = $dateTimeResult;
        }

        $dictationResult->fill($dictationResultData);
        $dictationResult->save();

        return $dictationResult;
    }

    public function deleteDictationResult($dictationResult)
    {
        return $dictationResult->delete();
    }
}
