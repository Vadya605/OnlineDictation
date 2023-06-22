<?php

namespace App\Repositories\Dictation;

use App\Models\Dictation;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class DictationRepository
{
    public function getAllDictation($outputValues)
    {
        return Dictation::orderBy($outputValues['column_sort'], $outputValues['option_sort'])
            ->whereRaw("{$outputValues['column_filter']} {$outputValues['option_filter']} {$outputValues['value_filter']}")
            ->when($outputValues['search_value'], function (Builder $query, $searchValue) {
                $query->where('title', 'like', '%'.$searchValue.'%')
                    ->orWhereRaw("DATE_FORMAT(from_date_time, '%Y-%m-%d %H:%i:%s') LIKE ?", ['%'.$searchValue.'%'])
                    ->orWhereRaw("DATE_FORMAT(to_date_time, '%Y-%m-%d %H:%i:%s') LIKE ?", ['%'.$searchValue.'%']);

            })
            ->paginate(10);
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

    public function deleteDictation(Dictation $dictation)
    {
        $dictation->delete();
    }
}
