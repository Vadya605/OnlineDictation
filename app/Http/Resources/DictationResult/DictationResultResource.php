<?php

namespace App\Http\Resources\DictationResult;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Dictation\DictationResource;
use App\Http\Resources\User\UserResource;

class DictationResultResource extends JsonResource
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
            'text_result' => $this->text_result,
            'is_checked' => $this->is_checked,
            'mark' => $this->mark,
            'date_time_result' => $this->date_time_result,
            'dictation' => new DictationResource($this->dictation),
            'user' => new UserResource($this->user),
            'slug' => $this->slug,
        ];
    }
}
