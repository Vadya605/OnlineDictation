<?php

namespace App\Http\Requests\Admin\Dictation;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class StoreDictationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation()
    {
        $fromDateTime = $this->input('from_date_time');
        $toDateTime = $this->input('to_date_time');

        $formattedFromDateTime = Carbon::parse($fromDateTime)->format('Y-m-d H:i:s');
        $formattedToDateTime = Carbon::parse($toDateTime)->format('Y-m-d H:i:s');

        $this->merge([
            'from_date_time' => $formattedFromDateTime,
            'to_date_time' => $formattedToDateTime
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:191',
            // 'video_link' => 'required|active_url',
            'video_link' => 'nullable|string',
            'is_active' => 'nullable|boolean',
            'description' => 'nullable|string',
            'from_date_time' => 'nullable|date_format:Y-m-d H:i:s',
            'to_date_time' => 'nullable|date_format:Y-m-d H:i:s|
                                after_or_equal:from_date_time'
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'Название диктанта',
            'video_link' => 'Ссылка на видео',
            'is_active' => 'Активен',
            'description' => 'Описание',
            'from_date_time' => 'Дата начала диктанта',
            'to_date_time' => 'Дата окончания диктанта'
        ];
    }
}
