<?php

namespace Modules\Coupon\Http\Controllers;

use App\Http\Controllers\BasicController;
use Illuminate\Http\Request;
use App\Functions\Upload;
use Illuminate\Support\Str;
use Modules\Coupon\Entities\Model;
use Modules\Coupon\Http\Requests\CouponRequest;

class Controller extends BasicController
{
    public function index(Request $request)
    {
        $Models = Model::get();

        return view('coupon::index', compact('Models'));
    }


    public function create()
    {
        return view('coupon::create');
    }


    public function store(CouponRequest $request)
    {
        // Generate a random code
        $randomCode = Str::random(8);
        while (Model::where('code', $randomCode)->exists()) {
            // If the code already exists, generate a new one
            $randomCode = Str::random(8);
        }

        // Create a new model instance with the unique code
        $Model = Model::create(array_merge($request->all(), ['code' => $randomCode]));

        alert()->success(__('trans.addedSuccessfully'));

        return redirect()->back();
    }


    public function show($id)
    {
        $Model = Model::where('id', $id)->firstorfail();

        return view('coupon::show', compact('Model'));
    }


    public function edit($id)
    {
        $Model = Model::where('id', $id)->firstorfail();

        return view('coupon::edit', compact('Model'));
    }


    public function update(Request $request, $id)
    {
        $Model = Model::where('id', $id)->firstorfail();
        $Model->update($request->all());
        alert()->success(__('trans.updatedSuccessfully'));

        return redirect()->back();
    }


    public function destroy($id)
    {
        $Model = Model::where('id', $id)->delete();
    }

    /*** To change coupon status or not ***/
    public function changeStatus(Model $coupon)
    {
//        return $coupon;
        if ($coupon->is_active == '1'){
            $is_active = '0';
        }
        else{
            $is_active = '1';
        }

        $coupon->update(['is_active' => $is_active]);

        return response()->json(['is_active' => $coupon->is_active]);
    }

} //end of class
