<?php

namespace Modules\Device\Entities;

use App\Models\BaseModel;

class Header extends BaseModel
{
    protected $guarded = [];

    protected $table = 'device_header';

    public function Device()
    {
        return $this->belongsTo(Device::class);
    }
}
