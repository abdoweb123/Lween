<?php

namespace Modules\Product\Http\Controllers;

use App\Http\Controllers\BasicController;
use Illuminate\Http\Request;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\Gallery;

class GalleryController extends BasicController
{
    public function index($product_id, Request $request)
    {
        abort(404);
    }

    public function create(Product $Product)
    {
        return view('product::gallery.create', compact('Product'));
    }

    public function store(Product $Product, Request $request)
    {
        $Gallery = Gallery::create(['product_id' => $Product->id] + $request->all());
        alert()->success(__('trans.addedSuccessfully'));

        return redirect()->route('admin.products.show', ['product' => $Product]);
    }

    public function show($product_id, $gallery_id)
    {
        abort(404);
    }

    public function edit(Product $Product, Gallery $Gallery)
    {
        return view('product::gallery.edit', compact('Gallery', 'Product'));
    }

    public function update(Request $request, Product $Product, Gallery $Gallery)
    {
        $Gallery->update($request->all());
        alert()->success(__('trans.updatedSuccessfully'));

        return redirect()->route('admin.products.show', ['product' => $Product]);
    }

    public function destroy(Product $Product, Gallery $Gallery)
    {
        $Gallery->delete();
        alert()->success(__('trans.DeletedSuccessfully'));

        return redirect()->route('admin.products.show', ['product' => $Product]);
    }
}
