<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class IndexUserRequest extends FormRequest
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
            'sort_column' => 'nullable|in:id,created_at,email,name,role',
            'sort_option' => 'nullable|in:asc,desc',
            'filter_column' => 'nullable|in:id,role,name',
            'filter_option' => 'nullable|in:<,>,=,is',
            'filter_value' => 'nullable|string',
            'search' => 'nullable|string',
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
            'filter_column.nullable' =>  trans('custom_validation.admin.*.filter_column.nullable'),
            'filter_column.in' =>  trans('custom_validation.admin.*.filter_column.in'),
            'filter_option.nullable' => trans('custom_validation.admin.*.filter_option.nullable'),
            'filter_option.in' =>  trans('custom_validation.admin.*.filter_option.in'),
            'filter_value.nullable' => trans('custom_validation.admin.*.filter_value.nullable') ,
            'filter_value.string' => trans('custom_validation.admin.*.filter_value.string') ,
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
