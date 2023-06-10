<?php

namespace App\Http\Resources\DictationResult;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\DictationResource;
use App\Http\Resources\UserResource;

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
            'text_result' => $this->text_result,
            'date' => $this->date,
            'dictation' => new DictationResource($this->dictation),
            'user' => new UserResource($this->user),
        ];
    }
}
