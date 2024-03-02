<?php

namespace Modules\Device\Entities;

use App\Models\BaseModel;
use Modules\Color\Entities\Model as Color;
use Modules\Memory\Entities\Model as Memory;
use Modules\OS\Entities\Model as OS;
use Modules\Processor\Entities\Model as Processor;
use Modules\Size\Entities\Model as Size;
use Modules\Storage\Entities\Model as Storage;

class DeviceItem extends BaseModel
{
    protected $guarded = [];

    protected $table = 'device_item';

    public function Device()
    {
        return $this->belongsTo(Device::class);
    }

    public function Color()
    {
        return $this->belongsTo(Color::class);
    }
    
    public function Size()
    {
        return $this->belongsTo(Size::class);
    }

    public function OS()
    {
        return $this->belongsTo(OS::class, 'os');
    }

    public function Processor()
    {
        return $this->belongsTo(Processor::class);
    }

    public function Memory()
    {
        return $this->belongsTo(Memory::class);
    }

    public function Storage()
    {
        return $this->belongsTo(Storage::class);
    }



    public function Price()
    {
        return format_number($this->price * Country()->currancy_value);
    }
    public function RealPrice()
    {
        if ($this->Device->discount_value && $this->Device->discount_from < now() && $this->Device->discount_to > now()) {
            return format_number(($this->price - ($this->price / 100 * $this->Device->discount_value)) * Country()->currancy_value);
        } else {
            return format_number($this->price * Country()->currancy_value);
        }
    }
    public function PriceWithCurrancy()
    {
        if ($this->Device->discount_value && $this->Device->discount_from < now() && $this->Device->discount_to > now()) {
            return format_number(($this->price - ($this->price / 100 * $this->Device->discount_value)) * Country()->currancy_value).' '.Country()->currancy_code;
        } else {
            return format_number($this->price * Country()->currancy_value).' '.Country()->currancy_code;
        }
    }
    public function CalcPrice()
    {
        if ($this->Device->discount_value && $this->Device->discount_from < now() && $this->Device->discount_to > now()) {
            return format_number(($this->price - ($this->price / 100 * $this->Device->discount_value)) * Country()->currancy_value);
        } else {
            return format_number($this->price * Country()->currancy_value);
        }
    }
    public function CalcPriceWithCurrancy()
    {
        if ($this->Device->discount_value && $this->Device->discount_from < now() && $this->Device->discount_to > now()) {
            return format_number(($this->price - ($this->price / 100 * $this->Device->discount_value)) * Country()->currancy_value).' '.Country()->currancy_code;
        } else {
            return format_number($this->price * Country()->currancy_value).' '.Country()->currancy_code;
        }
    }
}
