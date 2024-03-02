<?php

namespace App\Http\Requests\Client;

class AddressRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'region_id' => 'required',
            'block' => 'required',
            'road' => 'required',
            'street' => 'nullable',
            'building_no' => 'required',
            'floor_no' => 'required',
            'apartment' => 'required',
            'type' => 'nullable',
            'lat' => 'nullable',
            'long' => 'nullable',
            'additional_directions' => 'nullable',
        ];
    }
}
