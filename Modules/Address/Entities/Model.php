<?php

namespace Modules\Address\Entities;

use App\Models\BaseModel;
use Modules\Country\Entities\Region;
use Modules\Order\Entities\Model as Order;

class Model extends BaseModel
{
    protected $table = 'addresses';

    protected $With = ['Region'];

    protected $guarded = [];

    public function Region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    public function Orders()
    {
        return $this->hasMany(Order::class, 'address_id');
    }


}
