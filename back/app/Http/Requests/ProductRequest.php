<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|between:3,60|string',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string|between:0,65535',
            'discount' => 'required|numeric|min:0',
            'published' => 'required|boolean',
            'serial_code' => 'required|string',
            'quantity' => 'required|numeric|min:0',
            'category_id' => 'required|numeric|exists:App\Models\Category,id',
            'model_id' => 'required|numeric|exists:App\Models\Model,id',
            'brand_id' => 'required|numeric|exists:App\Models\Brand,id',
            'colors' => 'required|array|min:1',
            'colors.*' => 'numeric|exists:App\Models\Color,id',
            'images' => 'required|array|min:1',
            'images.*' => 'string|exists_file',
        ];
    }
}
