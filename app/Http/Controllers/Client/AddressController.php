<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\BasicController;
use App\Http\Requests\Client\AddressRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Address\Entities\Model as Address;
use Modules\Country\Entities\Region;

class AddressController extends BasicController
{
    public function index()
    {
        return view('Client.address.index');
    }

    public function create()
    {
        $regions = Region::orderBy('title_'.app()->getLocale())->get();
        $country_id = auth('client')->user()->country_id;

        return view('Client.address.create', compact('regions', 'country_id'));
    }

    public function store(AddressRequest $request)
    {

        DB::table('addresses')->insert([
            'client_id' => auth('client')->id(),
            'region_id' => $request->region_id,
            'block' => $request->block,
            'road' => $request->road,
            'building_no' => $request->building_no,
            'floor_no' => $request->floor_no,
            'apartment' => $request->apartment,
            'type' => $request->type,
            'lat' => $request->lat,
            'long' => $request->long,
            'additional_directions' => $request->additional_directions,
        ]);

        alert()->success(__('trans.addedSuccessfully'));

        return redirect()->route('client.profile', ['type' => 'addresses']);
    }

    public function edit($id)
    {
        $address = Address::findOrFail($id);
        $regions = Region::orderBy('title_'.app()->getLocale())->get();

        return view('Client.address.edit', compact('address', 'regions'));
    }

    public function update(Request $request, $id)
    {
        $address = Address::findOrFail($id);
        $address->region_id = $request->region_id;
        $address->block = $request->block;
        $address->road = $request->road;
        $address->building_no = $request->building_no;
        $address->floor_no = $request->floor_no;
        $address->apartment = $request->apartment;
        $address->type = $request->type;
        $address->lat = $request->lat;
        $address->long = $request->long;
        $address->additional_directions = $request->additional_directions;

        $address->save();
        if ($request->url == '1') {
            alert()->success(__('trans.updatedSuccessfully'));

            return redirect()->route('address.index');
        } else {
            alert()->success(__('trans.updatedSuccessfully'));

            return redirect()->route('client.profile', 'address');
        }
    }

    public function destroy($id)
    {
        $address = Address::findOrFail($id);
        try {
            $address->delete();
            alert()->success(__('trans.DeletedSuccessfully'));

            return redirect()->back();
        } catch (\Exception $e) {
            alert()->danger(__('trans.cantDeleteAddress'));

            return redirect()->back();
        }
    }
}
