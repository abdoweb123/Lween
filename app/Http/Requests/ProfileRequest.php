<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'phone' => ['required', 'numeric', 'min:10', 'unique:admins,phone,'.auth()->id().',id'],
            'name' => ['required', 'string', 'min:3'],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
        ];
    }
}
