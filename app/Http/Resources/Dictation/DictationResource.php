<?php

namespace App\Http\Resources\Dictation;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DictationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'answer' => $this->answer,
            'video_link' => $this->video_link,
            'is_active' => $this->is_active,
            'from_date_time' => $this->from_date_time,
            'to_date_time' => $this->to_date_time,
            'created_at' => $this->created_at
        ];
    }
}
