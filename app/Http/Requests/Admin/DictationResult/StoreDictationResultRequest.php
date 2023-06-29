<?php

namespace App\Http\Requests\Admin\DictationResult;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class StoreDictationResultRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation()
    {
        $dateTimeResult = $this->input('date_time_result');
        $formatteddateTimeResult = $dateTimeResult ? Carbon::parse($dateTimeResult)->format('Y-m-d H:i:s') : null;
        $this->merge(['date_time_result' => $formatteddateTimeResult]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'text_result' => 'required|string',
            'user_id' => [
                'required',
                Rule::unique('dictation_results')->where('dictation_id', $this->dictation_id)
            ],
            'dictation_id' => [
                'required',
                Rule::unique('dictation_results')->where('user_id', $this->user_id)
            ],
            'date_time_result' => 'required|date_format:Y-m-d H:i:s'
        ];
    }

    public function attributes(): array
    {
        return [
            'text_result' => 'Текст диктанта',
            'user_id' => 'Id пользователя',
            'dictation_id' => 'Id диктанта',
            'date_time_result' => 'Дата и время написания',
        ];
    }
}
