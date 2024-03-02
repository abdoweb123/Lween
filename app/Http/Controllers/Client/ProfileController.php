<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\BasicController;
use Illuminate\Http\Request;
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
}
