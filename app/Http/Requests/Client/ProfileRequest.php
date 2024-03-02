<?php

namespace App\Http\Requests\Client;

class ProfileRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3'],
            'email' => ['nullable', 'string', 'min:6'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ];
    }
}
