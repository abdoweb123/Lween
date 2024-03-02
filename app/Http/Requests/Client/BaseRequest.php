<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function withValidator($validator)
    {
        foreach ($validator->messages()->all() as $message) {
            toast($message, 'error');
        }

        return redirect()->back()->withErrors($validator);
    }
}
