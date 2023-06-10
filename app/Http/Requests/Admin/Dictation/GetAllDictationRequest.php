<?php

namespace App\Http\Requests\Admin\Dictation;

use Illuminate\Foundation\Http\FormRequest;

class GetAllDictationRequest extends FormRequest
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
            'column_sort' => 'nullable|in:id,created_at,from_date_time,to_date_time',
            'option_sort' => 'nullable|in:asc,desc'
        ];
    }
}
