<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required|between:2,20',
            'image' => 'required|image|max:1024',

        ];
        if($this->category_id != null){
            $rules['category_id'] = 'required|exists:categories,id';
        }
        return $rules;
    }
    public function attributes(): array
    {
        return [
            'image' => 'imagen',
            'category_id' => 'categoria',
        ];
    }
}
