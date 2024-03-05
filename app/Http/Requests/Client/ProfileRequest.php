<?php

namespace App\Http\Requests\Client;

class ProfileRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'current_password' => 'required',
            'name' => ['required', 'string', 'min:3'],
            'email' => ['nullable', 'string'],
        ];
    }
}
