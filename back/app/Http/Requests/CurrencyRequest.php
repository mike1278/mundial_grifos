<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CurrencyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'acronym' => 'required|string',
            'symbol' => 'required|string',
            'rate' => 'required|numeric',
        ];
    }
}
