<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:191'],
            'email' => ['required', 'string', 'email', 'max:191',
                Rule::unique('users')->ignore($this->id)
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('custom_validation.admin.users.name.required'),
            'name.string' => trans('custom_validation.admin.users.name.string'),
            'name.max' => trans('custom_validation.admin.users.name.max'),
            'email.required' => trans('custom_validation.admin.users.email.required'),
            'email.string' => trans('custom_validation.admin.users.email.string'),
            'email.email' => trans('custom_validation.admin.users.email.email'),
            'email.max' => trans('custom_validation.admin.users.email.max'),
            'email.unique' => trans('custom_validation.admin.users.email.unique'),
        ];
    }
}
