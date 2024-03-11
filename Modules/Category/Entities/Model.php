<?php

namespace Modules\Category\Entities;

use App\Models\BaseModel;
use Modules\Product\Entities\Product;

class Model extends BaseModel
{
    protected $guarded = [];

    protected $table = 'categories';

    public function parent()
    {
        return $this->belongsTo(Model::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Model::class, 'parent_id')->OrderByArrangement();
    }

    public function Products()
    {
        return $this->belongsToMany(Product::class, 'product_category', 'category_id', 'product_id');
    }

    public static function boot()
    {
        parent::boot();
        static::created(function ($model) {
            $model->arrangement = $model->id;
            $model->save();
        });
    }
}
