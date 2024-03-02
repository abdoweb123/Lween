<?php

namespace Modules\Country\Entities;

use App\Models\BaseModel;
use Modules\Block\Entities\Model as Block;

class Country extends BaseModel
{
    protected $guarded = [];

    protected $table = 'countries';

    protected $appends = ['currancy_code'];

    public function getCurrancyCodeAttribute()
    {
        return $this['currancy_code_'.lang()];
    }

    public function Blocks()
    {
        return $this->hasMany(Block::class);
    }

    public function Regions()
    {
        return $this->hasMany(Region::class);
    }
}
