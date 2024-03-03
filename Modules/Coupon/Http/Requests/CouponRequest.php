<?php

namespace Modules\Coupon\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules(){
        return[
            'value'=>['required','numeric'],
            'max_uses' => ['nullable', 'integer'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date'],
        ];
    }

}