<?php

namespace Modules\Product\Entities;

use App\Models\BaseModel;

class Header extends BaseModel
{
    protected $guarded = [];

    protected $table = 'product_header';

    public function Product()
    {
        return $this->belongsTo(Product::class);
    }
}
