<?php

namespace App\Models;

use Modules\Color\Entities\Model as Color;
use Modules\Device\Entities\Device;
use Modules\Height\Entities\Model as Height;
use Modules\Width\Entities\Model as Width;

class Cart extends BaseModel
{
    protected $guarded = [];

    protected $table = 'cart';


    /*** Start Relations ***/
    public function Device()
    {
        return $this->belongsTo(Device::class);
    }

    public function Color()
    {
        return $this->belongsTo(Color::class);
    }

    public function Height()
    {
        return $this->belongsTo(Height::class);
    }

    public function Width()
    {
        return $this->belongsTo(Width::class);
    }


} //end of class
