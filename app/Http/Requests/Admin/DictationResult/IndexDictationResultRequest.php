<?php

namespace App\Http\Requests\Admin\DictationResult;

use Illuminate\Foundation\Http\FormRequest;

class IndexDictationResultRequest extends FormRequest
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
            'sort_column' => 'nullable|
            in:dictation_results.id,dictation_results.created_at,dictation_results.date_time_result,dictations.title,users.name,users.email,dictation_results.text_result',
            'sort_option' => 'nullable|in:asc,desc',
            'dictation' => 'nullable|exists:dictations,id',
            'user' => 'nullable|exists:users,id',
            'date_from' => 'nullable|date_format:d.m.Y H:i',
            'date_to' => 'nullable|date_format:d.m.Y H:i|after_or_equal:date_from',
        ];
    }

    public function messages()
    {
        return [
            'sort_column.nullable' => trans('custom_validation.admin.*.sort_column.nullable') ,
            'sort_column.in' => trans('custom_validation.admin.*.sort_column.in') ,
            'sort_option.nullable' =>  trans('custom_validation.admin.*.sort_option.nullable'),
            'sort_option.in' =>  trans('custom_validation.admin.*.sort_option.in'),
            'dictation.exists' => trans('custom_validation.admin.dictation_results.dictation.exists'),
            'user.exists' => trans('custom_validation.admin.dictation_results.user.exists'),
            'date_from.nullable' =>  trans('custom_validation.admin.*.date_from.nullable'),
            'date_from.date_format' =>  trans('custom_validation.admin.*.date_from.date_format'),
            'date_to.nullable' =>  trans('custom_validation.admin.*.date_to.nullable'),
            'date_to.date_format' =>  trans('custom_validation.admin.*.date_to.date_format'),
            'date_to.after_or_equal' =>  trans('custom_validation.admin.*.date_to.after_or_equal'),
        ];
    }
}
