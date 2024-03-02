<?php

namespace Modules\Branch\Entities;

use App\Models\BaseModel;
use Modules\Category\Entities\Model as Category;
use Modules\Country\Entities\Country;
use Modules\Country\Entities\Region;
use Modules\Device\Entities\Device;

class Model extends BaseModel
{
    protected $guarded = [];

    protected $table = 'branches';

    public function Country()
    {
        return $this->belongsTo(Country::class);
    }

    public function Regions()
    {
        return $this->belongsToMany(Region::class, 'branch_region', 'branch_id', 'region_id');
    }

    public function Categories()
    {
        return $this->belongsToMany(Category::class, 'branch_category', 'branch_id', 'category_id');
    }

    public function Devices()
    {
        return $this->belongsToMany(Device::class, 'branch_device', 'branch_id', 'device_id');
    }
}
