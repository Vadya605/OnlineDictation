<?php

namespace App\Http\Requests\Admin\Dictation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IndexDictationRequest extends FormRequest
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
            'sort' => Rule::in(array_keys(config('params.sort.dictations'))),
            'filter' =>  Rule::in(array_keys(config('params.filter.dictations'))),
            'search' => 'nullable|string',
            'date_from' => 'nullable|date_format:d.m.Y H:i',
            'date_to' => 'nullable|date_format:d.m.Y H:i|after_or_equal:date_from',
        ];
    }

    public function messages()
    {
        return [
            'sort.in' => trans('custom_validation.admin.*.sort.in'),
            'filter.in' => trans('custom_validation.admin.*.filter.in'),
            'search.nullable' =>  trans('custom_validation.admin.*.search.nullable'),
            'search.string' =>  trans('custom_validation.admin.*.search.string'),
            'date_from.nullable' =>  trans('custom_validation.admin.*.date_from.nullable'),
            'date_from.date_format' =>  trans('custom_validation.admin.*.date_from.date_format'),
            'date_to.nullable' =>  trans('custom_validation.admin.*.date_to.nullable'),
            'date_to.date_format' =>  trans('custom_validation.admin.*.date_to.date_format'),
            'date_to.after_or_equal' =>  trans('custom_validation.admin.*.date_to.after_or_equal'),
        ];
    }
}
