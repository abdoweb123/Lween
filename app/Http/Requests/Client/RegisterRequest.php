<?php

namespace App\Http\Requests\Client;

class RegisterRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3'],
            'phone' => ['required', 'numeric', 'unique:clients,phone'],
            'email' => ['nullable', 'string'],
            'password' => ['required', 'string', 'confirmed', 'min:6'],
            'country_code'=>'required|exists:countries,country_code',
        ];
    }
}
