<?php

namespace Modules\Device\Entities;

use App\Models\BaseModel;

class Feature extends BaseModel
{
    protected $guarded = [];

    protected $table = 'device_feature';

    public function Device()
    {
        return $this->belongsTo(Device::class);
    }
}
