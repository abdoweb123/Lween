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

    public function chooseAddressShipping(Request $request)
    {
        $address = Address::query()->where('client_id',client_id())->first();
        return view('Client.Purchase',compact('address'));
    }


    public function addNewAddress($type=null)
    {
        if($type === 'profile'){
            return view('Client.addNewAddress',compact('type'));
        }
        return view('Client.addNewAddress');
    }


    public function storeAddress(Request $request, $type=null)
    {
        $request->validate([
            'region_id' => ['required','integer']
        ]);

        $checkAddress = Address::where('client_id',client_id())->first();

        if ($checkAddress){
            $checkAddress->delete();
        }

        $Address = Address::create([
            'client_id' => Client_id(),
            'region_id' => $request->region_id,
            'block' => $request->block,
            'road' => $request->road,
            'building_no' => $request->building_no,
            'floor_no' => $request->floor_no,
            'apartment' => $request->apartmentNo,
            'type' => $request->apartmentType,
            'additional_directions' => $request->additional_directions,
        ]);

        session()->flash('toast_message', ['type' => 'success', 'message' => __('trans.addedSuccessfully')]);

        if($type === 'profile'){
            return redirect()->route('Client.profile');
        }

        return redirect()->route('Client.chooseAddressShipping');
    }


    public function editAddress($id, $type=null)
    {
        $address = Address::query()->findOrFail($id);

        if($type === 'profile'){
            return view('Client.editAddress',compact('address','type'));
        }

        return view('Client.editAddress',compact('address'));
    }


    public function updateAddress(Request $request, $id, $type=null)
    {
        $address = Address::findOrFail($id);

        $address->update([
            'block' => $request->block,
            'road' => $request->road,
            'building_no' => $request->building_no,
            'floor_no' => $request->floor_no,
            'apartment' => $request->apartmentNo,
            'type' => $request->apartmentType,
            'additional_directions' => $request->additional_directions,
        ]);

        session()->flash('toast_message', ['type' => 'success', 'message' => __('trans.updatedSuccessfully')]);

        if($type === 'profile'){
            return redirect()->route('Client.profile');
        }

        return redirect()->route('Client.chooseAddressShipping');
    }


    public function deleteAddress(Request $request)
    {
        $addressId = $request->input('address_id');

        $address = Address::query()->find($addressId);
        if ($address){
            $address->delete();
            return response()->json([
                'message' => __('trans.DeletedSuccessfully')
            ]);
        }
        else{
            return response()->json([
                'message' => __('trans.somethingWrong')
            ]);
        }

    }


} //end of class

