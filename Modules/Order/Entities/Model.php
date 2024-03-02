<?php

namespace Modules\Order\Entities;

use App\Models\BaseModel;
use Modules\Address\Entities\Model as Address;
use Modules\Branch\Entities\Model as Branch;
use Modules\Client\Entities\Model as Client;
use Modules\Delivery\Entities\Model as Delivery;
use Modules\Payment\Entities\Model as Payment;
use Modules\Device\Entities\Device;

class Model extends BaseModel
{
    protected $guarded = [];

    protected $table = 'orders';

    public function Devices()
    {
        return $this->belongsToMany(Device::class, 'order_device', 'order_id', 'device_id')->withPivot('quantity', 'price', 'total', 'color_id');
    }

    public function Delivery()
    {
        return $this->belongsTo(Delivery::class, 'delivery_id');
    }
    public function Payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }

    public function Branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function Client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function Address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }
}
