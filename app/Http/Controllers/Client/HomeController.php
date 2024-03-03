<?php

namespace App\Http\Controllers\Client;

use App\Functions\WhatsApp;
use App\Http\Controllers\BasicController;
use App\Mail\OrderSummary;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Modules\Ad\Entities\Model as Ad;
use Modules\Address\Entities\Model as Address;
use Modules\Client\Entities\Model as Client;
use Modules\Contact\Entities\Model as Contact;
use Modules\Brand\Entities\Model as Brand;
use Modules\Country\Entities\Country;
use Modules\Device\Entities\Device;
use Modules\Order\Entities\Model as Order;
use Modules\Service\Entities\Model as Service;
use Modules\Category\Entities\Model as Category;
use Modules\Slider\Entities\Model as Slider;

class HomeController extends BasicController
{

    /*** Go to main page ***/
    public function home()
    {
        $locale = App::getLocale();

        $Ads = Ad::Active()->get();
        $Sliders = Slider::Active()->get();
        $Brands = Brand::Active()->get();
        $new_arrivals = Device::with(['Gallery', 'Categories'])->where('new_arrival', 1)->take(6)->get();
        $most_selling = Device::with(['Gallery', 'Categories'])->where('most_selling', 1)->take(6)->get();
        $featured = Device::where('featured', 1)->take(6)->get();
        $offers = Device::query()->HasDiscount()->take(3)->get();
        $Services = Service::Active()->get();

        return view('Client.mainPage', compact('Sliders', 'Ads', 'new_arrivals', 'most_selling', 'featured', 'offers', 'Services','Brands'));
    }


    public function device($device_id,$color_id = null)
    {
        $Device = Device::where('id', $device_id)->with(['Specs', 'Accessories', 'Categories', 'Features', 'Gallery'])->firstorfail();

        if($Device->Items->count() && $color_id == NULL){
            return redirect()->route('Client.device',['device_id'=>$device_id,'color_id'=>$Device->Items->whereNotNull('color_id')->first()->color_id]);
        }
        
        $wishlist = DB::table('wishlist')->where('client_id', client_id())->where('device_id', $Device->id)->exists();

        return view('Client.device', compact('Device', 'wishlist'));
    }


    public function BuildYourDevice ($device_id,$color_id)
    {
        $Device = Device::where('id', $device_id)->with(['Categories', 'Gallery','Items'])->firstorfail();

        return view('Client.build_your_device', compact('Device'));
    }


    public function report($device_id,$size_id,$color_id,$specification_id)
    {
        $Device = Device::where('id', $device_id)->with(['Categories', 'Gallery','Items'])->firstorfail();
        $SelectedItem = $Device->Items
            ->when($size_id, function ($query) use($size_id) {
                return $query->where('size_id', $size_id);
            })
            ->when($color_id, function ($query) use($color_id) {
                return $query->where('color_id', $color_id);
            })
            ->when($specification_id, function ($query) use($specification_id) {
                return $query->where('id', $specification_id);
            })
            ->first();
        $data = [
            'Device' => $Device,
            'SelectedItem' => $SelectedItem,
            'SelectedColor' => $color_id,
            'SelectedSize' => $size_id,
        ];
        $pdf = \niklasravnsborg\LaravelPdf\Facades\Pdf::loadView('Client.report', $data);
        return $pdf->stream('report.pdf');
    }


    public function categories(Request $request)
    {
        $Category = NULL;
        if(request('category')){        
            $Category = Category::Active()->where('id',request('category'))->first();
        }

        $Devices = Device::with(['Gallery', 'Categories'])
            ->when(request('brand_id'), function ($query) {
                return $query->where('brand_id', request('brand_id'));
            })
            ->when(request('categories'), function ($query) {
                return $query->whereHas('Categories', function ($query) {
                    $query->whereIn('categories.id', request('categories'));
                });
            })
            ->when(request('category'), function ($query) {
                return $query->whereHas('Categories', function ($query) {
                    $query->where('categories.id', request('category'));
                });
            })
            ->when(request('colors'), function ($query) {
                return $query->whereHas('Items', function ($query) {
                    $query->whereIn('device_item.color_id', request('sizes'));
                });
            })
            ->when(request('sizes'), function ($query) {
                return $query->whereHas('Items', function ($query) {
                    $query->whereIn('device_item.size_id', request('sizes'));
                });
            })
            ->when(request('processors'), function ($query) {
                return $query->whereIn('processor_id', request('processors'));
            })
            ->when(request('memories'), function ($query) {
                return $query->whereIn('memory_id', request('memories'));
            })
            ->when(request('storages'), function ($query) {
                return $query->whereIn('storage_id', request('storages'));
            })
            ->when(request('os'), function ($query) {
                return $query->whereIn('os', request('os'));
            })
            ->when(request('max_price'), function ($query) {
                return $query->where('price', '>=', request('max_price'));
            })
            ->when(request('min_price'), function ($query) {
                return $query->where('price', '>=', request('min_price'));
            })
            ->when(request('filter'), function ($query) {
                return $query->HasDiscount();
            })
            ->when(request('search'), function ($query) {
                $searchTerm = request('search');

                return $query->where('title_ar', 'LIKE', "%{$searchTerm}%")->orWhere('title_en', 'LIKE', "%{$searchTerm}%");
            })
            ->paginate(25);

        return view('Client.categories', compact('Devices','Category'));
    }


    public function submit($delivery_id, Request $request)
    {

        if (auth('client')->check()) {
            $Client = auth('client')->user();
        } else {
            $Client = Client::where('phone', "%{$request->phone}%")->first();
            if (! $Client) {
                $Client = Client::create([
                    'country_id' => $request->country_id,
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'password' => Hash::make(Str::random(10)),
                ]);
            }
        }

        if ($delivery_id == 1) {
            $branch_id = null;
            if ($request->address_id) {
                $Address = Address::find($request->address_id);
            } else {
                $Address = Address::create([
                    'client_id' => $Client->id,
                    'region_id' => $request->region_id,
                    'block' => $request->block,
                    'road' => $request->road,
                    'building_no' => $request->building_no,
                    'floor_no' => $request->floor_no,
                    'apartment' => $request->apartment,
                    'type' => $request->type,
                    'additional_directions' => $request->additional_directions,
                ]);
            }
        } else {
            $Address = null;
            $branch_id = $request->branch_id;
        }

        $Cart = Cart::where('client_id', client_id())->with('Device', 'Color')->get();
        $sub_total = 0;
        $discount = 0;
        foreach ($Cart as $key => $CartItem) {
            $PriceItem = $CartItem->Device->Items->when($CartItem->item_id, function ($query) use($CartItem) {
                                return $query->where('id', $CartItem->item_id);
                            })->first() ?? $CartItem->Device;
            $sub_total += $PriceItem->CalcPrice() * $CartItem->quantity;
            $discount += ($PriceItem->Price() - $PriceItem->CalcPrice()) * $CartItem->quantity;
        }
        $vat = $sub_total / 100 * setting('vat');
        $delivery_cost = $Address ? $Address->Region()->select('delivery_cost')->value('delivery_cost') : 0;
        $Order = Order::create([
            'client_id' => $Client->id,
            'delivery_id' => $delivery_id,
            'address_id' => $Address ? $Address->id : null,
            'branch_id' => $branch_id,
            'payment_id' => $request->payment_id,

            'sub_total' => $sub_total,
            'discount' => $discount,
            'discount_percentage' => 0,
            'vat' => $sub_total / 100 * setting('vat'),
            'vat_percentage' => setting('vat'),
            'coupon' => 0,
            'coupon_percentage' => 0,
            'charge_cost' => $delivery_cost,
            'net_total' => $sub_total + $vat + $delivery_cost,

        ]);

        foreach ($Cart as $key => $CartItem) {
            $SelectedItem = $CartItem->Device->Items->when($CartItem->item_id, function ($query) use($CartItem) {
                                return $query->where('id', $CartItem->item_id);
                            })->first() ?? $CartItem->Device;
            $Order->Devices()->attach($CartItem->device->id, [
                'color_id' => $CartItem->color_id > 0 ? $CartItem->color_id : null,
                'price' => $SelectedItem->Calcprice(),
                'quantity' => $CartItem->quantity,
                'total' => $SelectedItem->Calcprice() * $CartItem->quantity,
            ]);
            $CartItem->Device->Items()->when($CartItem->item_id, function ($query) use($CartItem) {
                return $query->where('id', $CartItem->item_id);
            })->decrement('quantity', $CartItem->quantity) ?? Device::where('id', $CartItem->device->id)->decrement('quantity', $CartItem->quantity);
            $CartItem->delete();
        }

        WhatsApp::SendOrder($Order->id);
        try {
            Mail::to(['apps@emcan-group.com', setting('email'), $Client->email])->send(new OrderSummary($Order));
        } catch (\Throwable $th) {

        }
        alert()->success(__('trans.order_added_successfully'));

        return redirect()->route('Client.home');
    }


    public function confirm(Request $request)
    {
        $Cart = Cart::where('client_id', client_id())->with('Device', 'Color')->get();

        return view('Client.confirm', compact('Cart'));
    }


    public function cart()
    {
        $Cart = Cart::where('client_id', client_id())->with('Device', 'Color')->get();

        return view('Client.cart', compact('Cart'));
    }


    public function deleteitem()
    {
        Cart::where('client_id', client_id())->where('id', request('id'))->delete();
        $cart_count = Cart::where('client_id', client_id())->count();

        return response()->json([
            'success' => true,
            'type' => 'success',
            'cart_count' => $cart_count,
            'message' => __('trans.DeletedSuccessfully'),
        ]);
    }


    public function minus()
    {
        if (request('count')) {
            Cart::where('client_id', client_id())->where('id', request('id'))->update(['quantity' => request('count')]);
            $cart_count = Cart::where('client_id', client_id())->count();

            return response()->json([
                'success' => true,
                'type' => 'success',
                'cart_count' => $cart_count,
                'message' => __('trans.updatedSuccessfully'),
            ]);
        } else {
            $cart_count = Cart::where('client_id', client_id())->count();

            return response()->json([
                'success' => false,
                'type' => 'error',
                'cart_count' => $cart_count,
                'message' => __('trans.sorry_there_was_an_error'),
            ]);
        }
    }


    public function plus()
    {
        $CartItem = Cart::where('client_id', client_id())->where('id', request('id'))->first();
        $DeviceQuantity = Device::where('id', $CartItem->device_id)->select('quantity')->value('quantity');
        if ($DeviceQuantity > 0) {
            if ($CartItem->quantity < $DeviceQuantity) {
                Cart::where('id', $CartItem->id)->increment('quantity', 1);
            } else {
                return response()->json([
                    'success' => false,
                    'type' => 'error',
                    'message' => __('trans.quantityNotenough'),
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'type' => 'error',
                'message' => __('trans.quantityNotenough'),
            ]);
        }

        $cart_count = Cart::where('client_id', client_id())->count();

        return response()->json([
            'success' => true,
            'type' => 'success',
            'cart_count' => $cart_count,
            'message' => __('trans.updatedSuccessfully'),
        ]);
    }


    public function AddToCart(Request $request)
    {
//        return $request;
        $device_id = $request->device_id;
        $quantity = $request->quantity ?? 1;
        $DeviceQuantity = Device::where('id', $device_id)->select('quantity')->value('quantity');

        if ($DeviceQuantity > 0) {
            $CartItem = Cart::query()->where('client_id', client_id())
                ->where('device_id', $device_id)
                ->where('height_id',$request->height_id)
                ->where('width_id',$request->width_id)
                ->where('sides_closure',$request->sides_closure ? '1' : '0')
                ->where('front_closure',$request->front_closure ? '1' : '0')->first();
            if ($CartItem) {
                if ($CartItem->quantity < $DeviceQuantity) {
                        Cart::where('id', $CartItem->id)->increment('quantity', $quantity);
                } else {
                    return response()->json([
                        'success' => false,
                        'type' => 'error',
                        'message' => __('trans.quantityNotenough'),
                    ]);
                }
            } else {
                // Store in cart
                Cart::insert([
                    'client_id' => client_id(),
                    'device_id' => $device_id,
                    'quantity' => $quantity,
                    'height_id' => $request->height_id,
                    'width_id' => $request->width_id,
                    'sides_closure' => $request->sides_closure ? '1' : '0',
                    'front_closure' => $request->front_closure ? '1' : '0',
                    'notes' => $request->notes,
                ]);

                // increase quantity in Device (product)
//                Device::query()->where('id', $device_id)->decrement('quantity', $quantity);
            }
        } else {
            return Redirect::back()->with([
                'success' => true,
                'type' => 'error',
                'message' => __('trans.quantityNotenough'),
            ]);
        }

//        $cart_count = Cart::where('client_id', client_id())->count();

        session()->flash('toast_message', ['type' => 'success', 'message' => __('trans.addedSuccessfully')]);
        return redirect()->route('Client.continuePurchasingCart');
    }


    /*** continue Buying Cart ***/
    public function continuePurchasingCart()
    {
        $carts = Cart::where('client_id', client_id())->get();

        // to get total price of cart elements without adding (coupon || vat)
        $sub_total = 0;
        foreach ($carts as $cart){
            if ($cart->Device->HasDiscount()){
                $sub_total += $cart->Device->RealPrice() * $cart->quantity;
            }
            else{
                $sub_total += $cart->Device->Price() * $cart->quantity;
            }
        }
        // To convert currency
        convertCurrency($sub_total);
        $sub_total = format_number($sub_total);

        return view('Client.cart',compact('carts','sub_total'));
    }


    /*** update product_cart quantity (with ajax) ***/
    public function updateProductCartQuantity(Request $request)
    {
        $cart = Cart::query()->where('client_id', client_id())
            ->where('id',$request->input('cart_id'))->first();

        $cart->update(['quantity'=>$request->input('quantity')]);
        return response()->json([
            'success' => true,
            'quantity' => $cart->quantity,
        ]);
    }

    /*** remove element from cart (with ajax) ***/
    public function removeCartElement(Request $request)
    {
        $cart = Cart::query()->where('client_id', client_id())
            ->where('id',$request->input('cart_id'))->first();

        $cart->delete();

        return response()->json([
            'success' => true,
        ]);
    }


    public function ToggleWishlist(Request $request)
    {
        $device_id = $request->device_id;

        if (DB::table('wishlist')->where('client_id', client_id())->where('device_id', $device_id)->exists()) {
            DB::table('wishlist')->where('client_id', client_id())->where('device_id', $device_id)->delete();

            return response()->json([
                'success' => true,
                'type' => 'success',
                'exists' => 0,
                'message' => __('trans.DeletedSuccessfully'),
            ]);
        } else {
            DB::table('wishlist')->insert([
                'client_id' => client_id(),
                'device_id' => $device_id,
            ]);

            return response()->json([
                'success' => true,
                'type' => 'success',
                'exists' => 1,
                'message' => __('trans.addedSuccessfully'),
            ]);
        }
    }


    public function contact(Request $request)
    {
        Contact::create($request->all());
        toast(__('trans.We Will Contact You as soon as possible'), 'success');

        return back();
    }


    public function getAllCategories(Request $request)
    {
        $categories = Category::Active()->whereHas('Devices')->get();
        return view('Client.categories', compact('categories'));
    }


    /*** change ( language, currency, country-region )  ***/
    public function changeWebsiteSettings(Request $request)
    {
//        return $request;

        // To change currency and country in (config)
        $country =  Countries()->where('currancy_code_en',$request->currancy_code)->first();
        session()->put('country',$country->id);
//     return   session()->get('country');
        Country($country->id);


        // To change addressCountry in (session)
        $country =  Countries()->where('id',$request->addressCountry_id)->first();
        session()->put('addressCountry', $country);


        // To change addressRegion in (session)
        $region =  regions()->where('id',$request->region_id)->first();
        session()->put('addressRegion', $region);


        // TO update language
        if (isset($request->language) && in_array($request->language, config('app.locales'))) {
            app()->setLocale($request->language);
            session()->put('locale', $request->language);
        }

        return redirect()->back();
    }


    /*** Get regions of country (with ajax) ***/
    public function getRegionsOfCountry(Request $request)
    {
        $countryId = $request->input('country_id');
        $regions = regions()->where('country_id', $countryId)->pluck('title_'.lang(), 'id');
        return response()->json($regions);
    }



}//end of class
