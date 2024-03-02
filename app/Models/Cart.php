<?php

namespace App\Models;

use Modules\Color\Entities\Model as Color;
use Modules\Device\Entities\Device;

class Cart extends BaseModel
{
    protected $guarded = [];

    protected $table = 'cart';

    public function Device()
    {
        return $this->belongsTo(Device::class);
    }

    public function Color()
    {
        return $this->belongsTo(Color::class);
    }
}
