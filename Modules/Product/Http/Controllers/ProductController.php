<?php

namespace Modules\Product\Http\Controllers;

use App\Functions\Upload;
use App\Http\Controllers\BasicController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Modules\Category\Entities\Model as Category;
use Modules\Brand\Entities\Model as Brand;
use Modules\Product\Http\Services\ProductService;
use Modules\Width\Entities\Model as Width;
use Modules\Height\Entities\Model as Height;
use Modules\Product\Entities\Product;

class ProductController extends BasicController
{

    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        $Products = Product::query()->paginate(25);

        return view('product::products.index', compact('Products'));
    }


    public function create()
    {
        $Brands = Brand::get();
        $Categories = Category::whereNull('parent_id')->with(['children' => function ($query) {
            $query->with(['Products', 'Parent'])->withCount('Products');
        }])->get();

        return view('product::products.create', compact('Categories','Brands'));
    }


    public function store(Request $request)
    {

        // Add additional data to the request
        $request->merge(['original_quantity' => $request->quantity]);

        // Access the merged data
        $value = $request->input('key');

        $Product = Product::create($request->only('title_ar', 'title_en','brand_id', 'quantity', 'original_quantity', 'short_desc_ar', 'short_desc_en', 'long_desc_ar', 'long_desc_en','price', 'discount_from', 'discount_to', 'discount_value'));

        $this->store_update($Product->id, $request);

        alert()->success(__('trans.addedSuccessfully'));

        return redirect()->route('admin.products.edit', $Product);
    }


    public function show($id)
    {
        return redirect()->route('admin.products.edit', ['product' => $id]);
    }


    public function edit($id)
    {
        $Brands = Brand::get();
        $Product = Product::with(['Gallery', 'Categories'])->where('id', $id)->firstorfail();
        $Categories = Category::whereNull('parent_id')->with(['children' => function ($query) use ($id) {
            $query->with(['Parent', 'Products' => function ($query2) use ($id) {
                $query2->whereNot('products.id', $id);
            }])->withCount('Products');
        }])->get();
        $Categories = Category::whereNull('parent_id')->with(['children' => function ($query) {
            $query->with(['Products', 'Parent'])->withCount('Products');
        }])->get();

        return view('product::products.edit', compact('Product', 'Categories','Brands'));
    }


    public function update(Request $request, $id)
    {
        $Product = Product::where('id', $id)->update($request->only('title_ar', 'title_en','brand_id', 'quantity', 'short_desc_ar', 'short_desc_en', 'long_desc_ar', 'long_desc_en','price', 'discount_from', 'discount_to', 'discount_value'));

        $this->store_update($id, $request);

        alert()->success(__('trans.updatedSuccessfully'));

        return redirect()->back();
    }


    public function destroy($id)
    {
        $Product = Product::where('id', $id)->delete();
    }


    public function gallery(Request $request)
    {
        $Product = Product::with(["Gallery" => function($q){
            $q->WhereNull('color_id')->orwhere('color_id',request('color_id'));
        },"Headers" => function($q){
            $q->WhereNull('color_id')->orwhere('color_id',request('color_id'));
        }])->where('id', request('product_id'))->firstorfail();
        if(request('color_id')){
            $Color = Color::where('id',request('color_id'))->first();
            return view('product::products.gallery', compact('Product','Color'));
        }else{
            $Colors = Color::whereIn('id',$Product->Items->pluck('color_id'))->get();
            return view('product::products.gallery', compact('Product','Colors'));
        }
    }


    public function post_gallery(Request $request)
    {
        $Product = Product::where('id', request('product_id'))->firstorfail();
        $Product->Gallery()->where('color_id',request('color_id'))->update(['color_id'=>NULL]);
        $Product->Gallery()->whereIn('image',(array)request('old_gallery'))->update(['color_id'=>request('color_id')]);
        if ($request->gallery) {
            foreach ($request->gallery as $gallery) {
                $Product->Gallery()->create([
                    'image' => Upload::UploadFile($gallery, 'Products'),
                ]);
            }
        }
        
        
        if ($request->hasFile('header')) {
            $Header = $Product->Headers()->where('color_id',request('color_id'))->first();
            if($Header){
                $Product->Headers()->update([
                    'header' => Upload::UploadFile($request->header, 'Products'),
                ]);
            }else{       
                $Product->Headers()->create([
                    'color_id'=>request('color_id'),
                    'header' => Upload::UploadFile($request->header, 'Products'),
                ]);
            }
        }
        
        alert()->success(__('trans.updatedSuccessfully'));
        
        return back();
    }


    public function store_update($id, Request $request)
    {
        $Product = Product::where('id', $id)->first();
        if ($request->hasFile('header')) {
            $Product->update([
                'header' => Upload::UploadFile($request->header, 'Products'),
            ]);
        }
        
        
        $Product->Categories()->sync(array_filter((array) $request->categories));

        if ($request->old_gallery) {
            Upload::deleteImages($Product->Gallery()->whereNotIn('image', $request->old_gallery)->pluck('image')->toarray());
            $Product->Gallery()->whereNotIn('image', $request->old_gallery)->delete();
        }
        if ($request->gallery) {
            foreach ($request->gallery as $gallery) {
                $Product->Gallery()->create([
                    'image' => Upload::UploadFile($gallery, 'Products'),
                ]);
            }
        }
    }

    public function new_arrivals(Request $request)
    {
        $Product = Product::select('id', 'new_arrival', 'title_'.lang())->get();

        return view('Product::new_arrivals', compact('Product'));
    }

    public function post_new_arrivals(Request $request)
    {
        Product::query()->update([
            'new_arrival' => 0,
        ]);
        Product::whereIn('id', array_filter((array) $request->products))->update([
            'new_arrival' => 1,
        ]);
        alert()->success(__('trans.updatedSuccessfully'));

        return redirect()->back();
    }

    public function mostselling(Request $request)
    {
        $Product = Product::select('id', 'most_selling', 'title_'.lang())->get();

        return view('Product::mostselling', compact('Product'));
    }

    public function post_mostselling(Request $request)
    {
        Product::query()->update([
            'most_selling' => 0,
        ]);
        Product::whereIn('id', array_filter((array) $request->products))->update([
            'most_selling' => 1,
        ]);
        alert()->success(__('trans.updates'));

        return redirect()->back();
    }

    public function featured(Request $request)
    {
        $Product = Product::select('id', 'featured', 'title_'.lang())->get();

        return view('Product::featured', compact('Product'));
    }

    public function post_featured(Request $request)
    {
        Product::query()->update([
            'featured' => 0,
        ]);
        Product::whereIn('id', array_filter((array) $request->products))->update([
            'featured' => 1,
        ]);
        alert()->success(__('trans.updatedSuccessfully'));

        return redirect()->back();
    }

    public function  get_details($id)
    {
        $widths = Width::all();
        $heights = Height::all();

        $productOptions = $this->productOptions($widths, $heights);

        $product = Product::query()->where('id',$id)->with(['gallery'=>function($q){
            $q->Active();
        }])->first();

        return view('Client.detailsPage', compact('product','widths','heights','productOptions'));
    }


    /*** To get Category's products in categoryProducts page (sortedBy) ***/
    public function getCategoryProducts($id, $searchBy = null)
    {
        $categoryProducts = $this->productService->getCategoryProductsSortBy($id, $searchBy);
        return view('Client.categoryProducts',compact('categoryProducts','searchBy'));
    }

    /*** To get all products in allProduct page (sortedBy) ***/
    public function getAllProducts(Request $request, $searchBy = null)
    {
        $products = $this->productService->getProductsSortBy($request, $searchBy);
        return view('Client.allProducts',compact('products','searchBy'));
    }

    

    /*** To change product to most_popular or not ***/
    public function changeMostPopular(Product $product)
    {
        if ($product->most_popular == '1'){
            $new_most_popular = '0';
        }
        else{
            $new_most_popular = '1';
        }

        $product->update(['most_popular' => $new_most_popular]);

        return response()->json(['most_popular' => $product->most_popular]);
    }


    /*** get combination of widths and heights ***/
    public function productOptions($widths, $heights)
    {
        $pairs = [];

        // Loop through each element of the heights table
        foreach ($heights as $height) {
            // Loop through each element of the widths table
            foreach ($widths as $width) {
                // Append the pair of height and width to the pairs array
                $pairs[] = ['height_title' => $height['title'], 'width_title' => $width['title_'.lang()]];
            }
        }
        return $pairs;
    }


}//end of class

