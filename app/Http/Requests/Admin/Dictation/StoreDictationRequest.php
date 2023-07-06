<?php

namespace App\Http\Requests\Admin\Dictation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:191',
            'video_link' => 'nullable|active_url',
            'is_active' => 'boolean',
            'description' => 'nullable|string',
            'from_date_time' => 'nullable|date_format:d.m.Y H:i',
            'to_date_time' => 'nullable|date_format:d.m.Y H:i|
                                after_or_equal:from_date_time'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => trans('custom_validation.admin.dictations.title.required'),
            'title.string' => trans('custom_validation.admin.dictations.title.string'),
            'title.max' => trans('custom_validation.admin.dictations.title.max'),
            'video_link.active_url' => trans('custom_validation.admin.dictations.video_link.active_url'),
            'is_active.boolean' => trans('custom_validation.admin.dictations.is_active.boolean'),
            'description.string' => trans('custom_validation.admin.dictations.description.string'),
            'from_date_time.date_format' => trans('custom_validation.admin.dictations.to_date_time.date_format'),
            'to_date_time.date_format' => trans('custom_validation.admin.dictations.to_date_time.date_format'),
            'to_date_time.after_or_equal' => trans('custom_validation.admin.dictations.to_date_time.after_or_equal'),
        ];
    }
}
