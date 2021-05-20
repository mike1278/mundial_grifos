<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModelRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|between:2,50'
        ];
    }
}
