<?php

namespace App\Http\Requests\Client;

class LoginRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'phone' => 'required|string',
            'password' => 'required|string',
        ];
    }


}
