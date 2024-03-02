<?php

namespace Modules\Client\Requests;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Rule;


class PhoneLength implements Rule
//class PhoneLength extends Reques
{
    protected $countryCode;
    protected $max;

    public function __construct($countryCode,$max)
    {
        $this->countryCode = $countryCode;
        if($this->countryCode=='EG'){
            $max=10;
            $this->max=$max;

        }elseif($this->countryCode=='SA'||$this->countryCode=='AE'){
            $max=9;
            $this->max=$max;
        }else{
            $max=8;
            $this->max=$max;
        }

    }

    public function passes($attribute, $value)
    {
        if($this->countryCode=='EG'){
            return strlen($value) <= 10;
        }elseif($this->countryCode=='SA'||$this->countryCode=='AE'){
            return strlen($value) <= 9;
        }else{
            return strlen($value) <= 8;
        }
    }

    public function message()
    {
        if(lang()=='ar'){
            return 'رقم الهاتف يجيب ان يكون اقصي عدد ارقام لة '.$this->max;
        }
        else{
            return 'The Phone must be '.$this->max. ' digits for the provided country code.';

        }
    }

}