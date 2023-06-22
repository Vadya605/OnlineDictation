<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class GetAllUserRequest extends FormRequest
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
            'column_sort' => 'nullable|in:id,created_at,role,name',
            'option_sotr' => 'nullable|in:asc,desc',
            'column_filter' => 'nullable|in:id,role,name,vk_id',
            'option_filter' => 'nullable|in:<,>,=,is',
            'value_filter' => 'nullable|string',
            'search_value' => 'nullable|string'
        ];
    }

    public function attributes()
    {
        return [
            'column_sort' => 'Столбец сортировки',
            'option_sort' => 'Параметр сортировки',
            'column_filter' => 'Столбец фильтрации',
            'option_filter' => 'Параметр фильтрации',
            'value_filter' => 'Значение фильтрации',
            'search_value' => 'Значение поиска',
        ];
    }
    
    public function mergeDafault()
    {
        $this->merge([
            'column_sort' => $this->column_sort ?? 'id',
            'option_sort' => $this->option_sort ?? 'asc',
            'column_filter' => $this->column_filter ?? 'id',
            'option_filter' => $this->option_filter ?? '>',
            'value_filter' => $this->value_filter ?? '1',
            'search_value' => $this->search_value ?? null,
        ]);

        return $this->all();
    }
}