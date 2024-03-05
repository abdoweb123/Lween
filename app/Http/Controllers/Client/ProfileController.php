<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\BasicController;
use App\Http\Requests\Client\ProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Modules\Address\Entities\Model as Address;
use Modules\Client\Entities\Model as Client;
use Modules\Order\Entities\Model as Order;

class ProfileController extends BasicController
{
    public function index(Request $request)
    {
        $page = 'Profile';
        if (! auth('client')->check()) {
            if (setting('login')) {
                return redirect()->route('client.login.index');
            } else {
                return redirect()->route('client.home');
            }
        }
        $section = $request->section ?? 'orders';
        $myorders = $request->myorders ? true : false;
        $currentOrders = Order::with('Products')->where('client_id', auth('client')->id())->whereIn('status', [0, 1])->whereIn('follow', [0, 1, 2])->latest()->get();
        $previousOrders = Order::with('Products')->where([['client_id', auth('client')->id()]])->whereIn('status', [1])->whereIn('follow', [3])->latest()->get();

        return view('Client.profile', compact('currentOrders', 'previousOrders', 'page', 'myorders', 'section'));
    }


    public function update(Request $request)
    {
        $client = auth('client')->user();
        $client->name = $request->get('name');
        $client->email = $request->get('email');
        if ($request->has('password') && ! empty($request->get('password'))) {
            $client->password = bcrypt($request->get('password'));
        }
        $client->save();
        toast(__('trans.profileUpdated', 'success'));

        return redirect()->back();
    }


    public function getProfile()
    {
        $client = auth('client')->user();
        $orders = Order::query()->where('client_id',$client->id)->get();
        $address = Address::query()->where('client_id',client_id())->first();

//        foreach ($orders as $order){
//            foreach ($order->Devices as $device){
//                return$device->pivot;
//            }
//        }

        return view('Client.profile',compact('client','address','orders'));
    }


    public function updateProfile(ProfileRequest $request)
    {
//        return $request;

        // Add validation rule for the new password if it is provided
        if ($request->filled('password')) {
            $rules['password'] = ['string', 'confirmed', 'min:6'];
            $request->validate($rules);
        }

        $user = auth('client')->user();

        // Check if the provided current password matches the user's current password
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => __('trans.incorrectCurrentPassword')]);
        }


        // Update the user's password if a new password is provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Update the user's info
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        session()->flash('toast_message', ['type' => 'success', 'message' => __('trans.updatedSuccessfully')]);
        return redirect()->route('Client.profile');
    }


    public function deleteAccount()
    {

        auth('client')->user()->delete();
        auth('client')->logout();

        session()->flash('toast_message', ['type' => 'success', 'message' => __('trans.accountDeletedSuccessfully')]);
        return redirect()->route('Client.home');
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


    public function editAddress($id, $type=null)
    {
        $address = Address::query()->findOrFail($id);

        // Check if edit come from profile page
        if ($type == 'profile'){
            return view('Client.editAddress',compact('address',compact('type')));
        }

        // so it comes from Client.Purchase
        return view('Client.editAddress',compact('address'));
    }


    public function updateAddress(Request $request, $id)
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
        return redirect()->route('Client.chooseAddressShipping');
    }

} //end of class
