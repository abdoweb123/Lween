<?php

namespace App\Models;

use Modules\Product\Entities\Product;
use Modules\Height\Entities\Model as Height;
use Modules\Width\Entities\Model as Width;

class Cart extends BaseModel
{
    protected $guarded = [];

    protected $table = 'cart';


    /*** Start Relations ***/
    public function Product()
    {
        return $this->belongsTo(Product::class);
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
