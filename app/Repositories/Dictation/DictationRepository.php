<?php

namespace App\Repositories\Dictation;

use App\Models\Dictation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DictationRepository
{
    public function getAllDictation($outputValues=[])
    {
        $dictations = Dictation::query()
            ->orderBy('created_at', 'desc');

        if($sort = Arr::get($outputValues, 'sort')){
            $sortParams = config("params.sort.dictations.{$sort}");
            $sortColumn = Arr::get($sortParams, 'sort_column');
            $sortOption = Arr::get($sortParams, 'sort_option');

            $dictations->getQuery()->orders = null;
            $dictations->orderBy($sortColumn, $sortOption);
        }


        if($filter = Arr::get($outputValues, 'filter')){
            $filterParams = config("params.filter.dictations.{$filter}");
            $filterColumn = Arr::get($filterParams, 'filter_column');
            $filterOption = Arr::get($filterParams, 'filter_option');
            $filterValue = Arr::get($filterParams, 'filter_value');

            switch($filterOption){
                case 'is not null':
                    $dictations->whereNotNull($filterColumn);
                    break;
                case 'is null':
                    $dictations->whereNull($filterColumn);
                    break;
                default:
                    $dictations->where($filterColumn, $filterOption, $filterValue);
            }
        }
        
        if($search = Arr::get($outputValues, 'search')){
            $dictations->where('title', 'like', '%'.$search.'%');
        }

        if($fromDateTime = Arr::get($outputValues, 'date_from')){
            $fromDateTime = Carbon::parse($fromDateTime)->format('Y-m-d H:i:s');
            $dictations->where('from_date_time', '>=', $fromDateTime);
        }

        if($toDateTime = Arr::get($outputValues, 'date_to')){
            $toDateTime = Carbon::parse($toDateTime)->format('Y-m-d H:i:s');
            $dictations->where('to_date_time', '<=', $toDateTime);
        }

        // return $dictations->toSql();


        return $dictations->paginate(10);
    }

    public function getResultsAutoCompleteSearch($searchValue=null)
    {
        return Dictation::where('title', 'like', "%{$searchValue}%")->get();
    }

    public function getDictationsByChunk(callable $callback)
    {
        Dictation::chunk(10, $callback);
    }

    public function getCountDictation()
    {
        return Dictation::count();
    }

    public function getDictationBySlug($slug)
    {
        return Dictation::where('slug', $slug)->first();
    }

    public function getActiveDictation()
    {
        $now = Carbon::now()->setTimezone('Europe/Minsk')->format('Y-m-d H:i:s');

        return Dictation::where('is_active', true)
            ->where('from_date_time', '<=', $now)
            ->where('to_date_time', '>', $now)->first();
    }

    public function createDictation($dictationData)
    {
        $newDictation = new Dictation;

        $fromDateTime = Carbon::parse($dictationData['from_date_time'])->format('Y-m-d H:i:s');
        $toDateTime = Carbon::parse($dictationData['to_date_time'])->format('Y-m-d H:i:s');

        $newDictation->title = $dictationData['title'];
        $newDictation->video_link = $dictationData['video_link'];
        $newDictation->is_active = $dictationData['is_active'];
        $newDictation->video_link = $dictationData['video_link'];
        $newDictation->description = $dictationData['description'];
        $newDictation->from_date_time = $fromDateTime;
        $newDictation->to_date_time=$toDateTime;
        $newDictation->answer = $dictationData['answer'];
        $newDictation->save();

        return $newDictation;
    }

    public function isDictationAnswerUpdated(Dictation $dictation)
    {
        return $dictation->wasChanged('answer');
    }

    public function updateDictation(Dictation $dictation, $changeDictationData)
    {
        $changeDictationData['from_date_time'] = Carbon::parse($changeDictationData['from_date_time'])->format('Y-m-d H:i:s');
        $changeDictationData['to_date_time'] = Carbon::parse($changeDictationData['to_date_time'])->format('Y-m-d H:i:s');

        $dictation->fill($changeDictationData);
        $dictation->save();

        return $dictation;
    }

    public function deleteDictation(Dictation $dictation)
    {
        $dictation->delete();
    }
}
