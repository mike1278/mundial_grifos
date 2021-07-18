<?php

namespace App\Http\Requests;

use App\Rules\Lat;
use App\Rules\Long;
use App\Rules\Phone;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Password;

class ClientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|between:2,40',
            'lastname' => 'required|string|between:2,40',
            'phone' => [
                'required',
                'between:10,11',
                new Phone
            ],
            'dni' => 'required|between:7,8',
            'email' => 'required|between:9,255',
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->numbers()
                    ->letters()
                    ->mixedCase()
                    ->symbols()
            ],
            'location' => 'required|between:3,3',
            'location.address' => 'required|string',
            'location.lat' => [
                'required',
                new Lat
            ],
            'location.lng' => [
                'required',
                new Long
            ],
        ];
    }
}
