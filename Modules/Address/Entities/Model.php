<?php

namespace Modules\Address\Entities;

use App\Models\BaseModel;
use Modules\Country\Entities\Region;

class Model extends BaseModel
{
    protected $table = 'addresses';

    protected $With = ['Region'];

    protected $guarded = [];

    public function Region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }


}
