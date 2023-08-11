<?php

namespace App\Http\Requests\Admin\DictationResult;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDictationResultRequest extends FormRequest
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
            'user_id' => [
                'required',
                'exists:users,id',
                Rule::unique('dictation_results')->where('dictation_id', $this->dictation_id)
                    ->ignore($this->slug, 'slug')
            ],
            'dictation_id' => [
                'required',
                'exists:dictations,id',
                Rule::unique('dictation_results')->where('user_id', $this->user_id)
                    ->ignore($this->slug, 'slug')
            ],
            'is_checked' => 'required|boolean',
            'mark' => 'nullable|required_if:is_checked,true|integer',
            'date_time_result' => 'required|date_format:d.m.Y H:i'
        ];
    }

    public function messages()
    {
        return [
            'text_result.required' => trans('custom_validation.admin.dictation_results.text_result.required'),
            'text_result.string' => trans('custom_validation.admin.dictation_results.text_result.string'),
            'user_id.unique' => trans('custom_validation.admin.dictation_results.user_id.unique'),
            'user_id.exists' => trans('custom_validation.admin.dictation_results.user.exists'),
            'dictation_id.required' => trans('custom_validation.admin.dictation_results.dictation_id.required'),
            'dictation_id.unique' => trans('custom_validation.admin.dictation_results.dictation_id.unique'),
            'dictation_id.exists' => trans('custom_validation.admin.dictation_results.dictation.exists'),
            'mark.required_if' => trans('custom_validation.admin.dictation_results.mark.required_if'),
            'mark.integer' => trans('custom_validation.admin.dictation_results.mark.integer'),
            'date_time_result.required' => trans('custom_validation.admin.dictation_results.date_time_result.required'),
            'date_time_result.date_format' => trans('custom_validation.admin.dictation_results.date_time_result.date_format')
        ];
    }
}
