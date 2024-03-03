<?php

namespace Modules\Country\Entities;

use App\Models\BaseModel;

class Region extends BaseModel
{
    protected $guarded = [];

    protected $table = 'regions';

    public function Country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }


}
