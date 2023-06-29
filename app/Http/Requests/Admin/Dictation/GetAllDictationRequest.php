<?php

namespace App\Http\Requests\Admin\Dictation;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

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
            'column_sort' => 'nullable|in:id,created_at,title,from_date_time,to_date_time,is_active,video_link,description,created_at',
            'option_sort' => 'nullable|in:asc,desc',
            'column_filter' => 'nullable|in:id,is_active,video_link,from_date_time,to_date_time,description',
            'option_filter' => 'nullable|in:<,>,=,is,is not',
            'value_filter' => 'nullable|string',
            'search_value' => 'nullable|string',
            'from_date' => 'required_with:to_date|string',
            'to_date' => 'required_with:from_date|string',
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
            'from_date' => 'Дата от',
            'to_date' => 'Дата до',
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
            'from_date' => $this->from_date ?? null,
            'to_date' => $this->to_date ?? null,
        ]);

        return $this->all();
    }
}
