<?php

namespace App\Http\Requests\Client;

class ForgetRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'phone' => 'required|string',
        ];
    }
}
