<?php

namespace Modules\Device\Entities;

use App\Models\BaseModel;

class Gallery extends BaseModel
{
    protected $guarded = [];

    protected $table = 'device_gallery';

    public function Device()
    {
        return $this->belongsTo(Device::class);
    }
}
