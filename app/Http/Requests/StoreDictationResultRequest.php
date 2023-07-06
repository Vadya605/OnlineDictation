<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class StoreDictationResultRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
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
            'user_id' => 'required|exists:users,id',
            'dictation_id' => 'required|exists:dictations,id',
            'date_time_result' => 'required|date_format:d.m.Y H:i:s'
        ];
    }

    public function messages()
    {
        return [
            'text_result.required' => trans('custom_validation.user.dictationWriting.text_result.required'),
            'text_result.string' => trans('custom_validation.user.dictationWriting.text_result.string')
        ];
    }
}
