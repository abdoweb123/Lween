<?php

namespace Modules\Order\Http\Controllers;

use App\Http\Controllers\BasicController;
use Illuminate\Http\Request;
use Modules\Order\Entities\Model;
use App\Functions\WhatsApp;

class Controller extends BasicController
{
    public function index(Request $request)
    {
        $Models = Model::latest()->with('Delivery', 'Branch', 'Client.Country', 'Products', 'Address')->get();

        return view('order::index', compact('Models'));
    }

    public function destroy($id)
    {
        $Model = Model::where('id', $id)->delete();
    }
    
    public function changestatus(Request $request)
    {
        $Order = Model::where('id', $request->id)->first();
        $Order->status = $request->status;
        $Order->save();

        if($Order->delivery_id == 1){
            if( $request->status == 4){
                $msg =  'order_rejected';
            }
            elseif( $request->status == 0){
                $msg =  'order_pending';
            }
            elseif( $request->status == 1){
                $msg =  'order_preparing';
            }
            elseif( $request->status == 2){
                $msg =  'order_ready';
            }
            else{
                $msg = 'order_delivered';
            }
        }
        
        $message  = '%0a *(' .env('APP_NAME').')* %0a';
        $message .= '%0a *Order Number :* ' . $Order->id;
        $message .= '%0a '.__('trans.'.$msg).' %0a';
        $message .= '%0a *Powered By Emcan Solutions* %0a';
        
        
        WhatsApp::SendWhatsApp($Order->client()->first()->Country->phone_code . $Order->client()->first()->phone,$message);
        alert()->success(__('trans.'.$msg));
        return response()->json([
                'message' => __('trans.'.$msg),
            ]);
    }

}
