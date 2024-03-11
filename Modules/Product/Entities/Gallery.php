<?php

namespace Modules\Product\Entities;

use App\Models\BaseModel;

class Gallery extends BaseModel
{
    protected $guarded = [];

    protected $table = 'product_gallery';

    public function Product()
    {
        return $this->belongsTo(Product::class);
    }
}
