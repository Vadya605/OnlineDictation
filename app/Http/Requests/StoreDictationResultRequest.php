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

    public function prepareForValidation()
    {
        $date = $this->input('date');
        $formattedDate = Carbon::parse($date)->format('Y-m-d');
        $this->merge(['date' => $formattedDate]);
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
            'date' => 'required|date_format:Y-m-d'
        ];
    }
}
