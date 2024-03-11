<?php

use App\Models\Cart;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Modules\Branch\Entities\Model as Branch;
use Modules\Country\Entities\Country;
use Modules\Country\Entities\Region;
use Modules\Delivery\Entities\Model as Delivery;
use Modules\Product\Entities\Product as Product;
use Modules\FAQ\Entities\Model as FAQ;
use Modules\Order\Entities\Model as Order;
use Modules\Payment\Entities\Model as Payment;
use Modules\Setting\Entities\Model as Setting;


function format_number($number)
{
    return number_format($number, Country()->decimals, '.', '');
}
function cart_count()
{
    if (! Config::get('cart_count')) {
        Config::set('cart_count', Cart::where('client_id', client_id())->count() );
    }

    return Config::get('cart_count');
}

function client_id()
{
    if (auth('client')->check()) {
        return auth('client')->id();
    } else {
        if (! session()->get('client_id')) {
            session()->put('client_id', rand(99999, 999999));
        }

        return session()->get('client_id');
    }
}

function lang($lang = null)
{
    if (isset($lang)) {
        return app()->islocale($lang);
    } else {
        return app()->getlocale();
    }
}


function CurrentOrders()
{
    if (! Config::get('CurrentOrders')) {
        Config::set('CurrentOrders', Order::latest()->with('Branch', 'Client.Country', 'Products', 'Address')->where('status', 0)->get());
    }

    return Config::get('CurrentOrders');
}
function PreviousOrders()
{
    if (! Config::get('PreviousOrders')) {
        Config::set('PreviousOrders', Order::latest()->with('Branch', 'Client.Country', 'Products', 'Address')->where('status', 1)->get());
    }

    return Config::get('PreviousOrders');
}
function Wishlist()
{
    if (! Config::get('Wishlist')) {
        Config::set('Wishlist', Product::whereIn('id', DB::table('wishlist')->where('client_id', client_id())->pluck('product_id'))->get());
    }

    return Config::get('Wishlist');
}


function FAQ()
{
    if (! Config::get('FAQ')) {
        Config::set('FAQ', FAQ::Active()->get());
    }

    return Config::get('FAQ');
}



function Deliveries()
{
    if (! Config::get('Deliveries')) {
        Config::set('Deliveries', Delivery::Active()->get());
    }

    return Config::get('Deliveries');
}

function Branches()
{
    if (! Config::get('Branches')) {
        Config::set('Branches', Branch::Active()->get());
    }

    return Config::get('Branches');
}
function Payments()
{
    if (! Config::get('Payments')) {
        Config::set('Payments', Payment::Active()->get());
    }

    return Config::get('Payments');
}

function Countries()
{
    if (! Config::get('Countries')) {
        Config::set('Countries', Country::Active()->get());
    }

    return Config::get('Countries');
}

function Country($id = NULL)
{
    if(request()->route()->getName() == 'Client.submit'){
        $id = 2;
    }else{
        $id = $id ?? (session()->get('country') ?? 2); // 2-> saudi arabia
    }
    if (! Config::get('Country')) {
        Config::set('Country', Countries()->where('id', $id)->first());
    }

    return Config::get('Country');
}


//function addressCountry($id = NULL)
//{
//    if (! Config::get('addressCountry')) {
//        Config::set('addressCountry', Countries()->where('id', $id)->first());
//    }
//
//    return Config::get('addressCountry');
//}


function regions()
{
    if (! Config::get('regions')) {
        Config::set('regions', Region::Active()->get());
    }

    return Config::get('regions');
}


function region($id = NULL)
{
    $id = $id ?? (session()->get('region') ?? 385); // 2-> Riyadh
    if (! Config::get('region')) {
        Config::set('region', regions()->where('id', $id)->first());
    }

    return Config::get('region');
}



function Settings()
{
    if (! Config::get('Settings')) {
        Config::set('Settings', Setting::Active()->get());
    }

    return Config::get('Settings');
}

function setting($key)
{
    return Settings()->where('key', $key)->first()?->value;
}

function DT_Lang()
{
    if (lang('ar')) {
        return '//cdn.datatables.net/plug-ins/1.10.16/i18n/Arabic.json';
    } else {
        return '//cdn.datatables.net/plug-ins/1.10.16/i18n/English.json';
    }
}

function percent($percentage, $total)
{
    return ($percentage / 100) * $total;
}

function IsVideo($path)
{
    return str_contains($path, 'm4v') || str_contains($path, 'mpg') || str_contains($path, 'mp4');
}

function Brands()
{
    if (! Config::get('Brands')) {
        Config::set('Brands', \Modules\Brand\Entities\Model::Active()->get());
    }

    return Config::get('Brands');
}

//function Categories()
//{
//    if (! Config::get('Categories')) {
//        Config::set('Categories', \Modules\Category\Entities\Model::whereNull('parent_id')->orderBy('arrangement')->with('children')->withCount('children')->Active()->get());
//    }
//
//    return Config::get('Categories');
//}

function Categories()
{
    if (! Config::get('Categories')) {

       return  $Categories = \Modules\Category\Entities\Model::Active()->whereHas('Products')->with(['Products'=>function($query){
            $query->Active();
        }])->get();
    }

    return Config::get('Categories');
}



function convertCurrency($price)
{
    return format_number($price * Country()->currancy_value);
}




