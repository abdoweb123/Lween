<?php

namespace Modules\Product\Http\Services;

use Modules\Category\Entities\Model as Category;
use Modules\Product\Entities\Product;
use Modules\Product\Http\Controllers\ProductController;

class ProductService
{

    public function getCategoryProductsSortBy($id, $searchBy=null)
    {
        return $categoryProducts = Category::query()->with(['products'=>function($q) use ($searchBy){

            $q->where('quantity','>',0);

            if ($searchBy){
                if ($searchBy == 'most_popular')
                {
                    $q->orderBy('most_popular', 'desc');
                }
                elseif ($searchBy == 'lowest_price'){
                    $q->orderBy('price', 'asc');
                }
                elseif ($searchBy == 'highest_price'){
                    $q->orderBy('price', 'desc');
                }
                elseif ($searchBy == 'newest'){
                    $q->orderBy('created_at', 'desc');
                }
            }
            else{
                $q->orderBy('created_at', 'desc');
            }

        }])->findOrFail($id);
    }


    public function getProductsSortBy($request, $searchBy=null)
    {
        if ($request->search) {
            $products = Product::query()
                ->where('title_ar','LIKE','%'.$request->search.'%')
                ->orWhere('title_en','LIKE','%'.$request->search.'%')
                ->orWhereHas('Categories', function ($query) use ($request) {
                    $query->where('title_ar', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('title_en', 'LIKE', '%' . $request->search . '%');
                });
        }
        else{
            $products = Product::query();
        }

        $products->where('quantity','>',0);

        if ($searchBy){
            if ($searchBy == 'most_popular')
            {
                $products->orderBy('most_popular', 'desc');
            }
            elseif ($searchBy == 'lowest_price'){
                $products->orderBy('price', 'asc');
            }
            elseif ($searchBy == 'highest_price'){
                $products->orderBy('price', 'desc');
            }
            elseif ($searchBy == 'newest'){
                $products->orderBy('created_at', 'desc');
            }
        }
        else{
            $products->orderBy('created_at', 'desc');
        }

        return $products->get();
    }



} //end of class