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
            $dictations->where('from_date_time', '>=', Carbon::parse($fromDateTime)->format('Y-m-d H:i:s'));
        }

        if($toDateTime = Arr::get($outputValues, 'date_to')){
            $dictations->where('to_date_time', '<=', Carbon::parse($toDateTime)->format('Y-m-d H:i:s'));
        }

        // return $dictations->toSql();


        return $dictations->paginate(10);
    }

    public function getResultsAutoCompleteSearch($searchValue=null)
    {
        return Dictation::where('title', 'like', "%{$searchValue}%")->get();
    }

    public function getCountDictation()
    {
        return Dictation::count();
    }

    public function getDictationById($id)
    {
        return Dictation::find($id);
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

        if($fromDateTime = Arr::get($dictationData, 'from_date_time')){
            $fromDateTime = Carbon::parse($fromDateTime)->format('Y-m-d H:i:s');
        }

        if($toDateTime = Arr::get($dictationData, 'to_date_time')){
            $toDateTime = Carbon::parse($toDateTime)->format('Y-m-d H:i:s');
        }

        $newDictation->title=$dictationData['title'];
        $newDictation->video_link=$dictationData['video_link'];
        $newDictation->is_active=$dictationData['is_active'];
        $newDictation->video_link=$dictationData['video_link'];
        $newDictation->description=$dictationData['description'];
        $newDictation->from_date_time = $fromDateTime;
        $newDictation->to_date_time=$toDateTime;
        $newDictation->slug = Str::slug($dictationData['title']);
        $newDictation->save();

        return $newDictation;
    }

    public function updateDictation(Dictation $dictation, $changeDictationData)
    {
        if($fromDateTime = Arr::get($changeDictationData, 'from_date_time')){
            $fromDateTime = Carbon::parse($fromDateTime)->format('Y-m-d H:i:s');
            $changeDictationData['from_date_time'] = $fromDateTime;
        }

        if($toDateTime = Arr::get($changeDictationData, 'to_date_time')){
            $toDateTime = Carbon::parse($toDateTime)->format('Y-m-d H:i:s');
            $changeDictationData['to_date_time'] = $toDateTime;
        }

        $changeDictationData['slug'] = Str::slug($changeDictationData['title']);

        $dictation->fill($changeDictationData);
        $dictation->save();

        return $dictation;
    }

    public function deleteDictation(Dictation $dictation)
    {
        $dictation->delete();
    }
}
