<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'title' => 'required|max:191',
            // 'video_link' => 'required|active_url',
            'video_link' => 'required',
            'is_active' => 'required|boolean',
            'description' => 'required',
            'start_date_time' => 'required|date_format:Y-m-d H:i:s',
            'end_date_time' => 'required|date_format:Y-m-d H:i:s|after_or_equal:start_date_time'
        ];
    }
}
