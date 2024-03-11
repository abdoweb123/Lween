<?php

namespace App\Functions;

use Modules\Order\Entities\Model as Order;

class WhatsApp
{
    public static function SendOTP($phone)
    {
        $otp = rand(100000, 999999);

        $body = '';
        $body .= '\n *('.env('APP_NAME').')* \n';
        $body .= '\n *Your Verification Code Is* '.$otp.' \n';
        $body .= '\n Powered By *Emcan Solutions*';

        self::SendWhatsApp($phone, $body);

        return $otp;
    }


    public static function SendOrder($id)
    {
        $Order = Order::with('Branch', 'Client.Country', 'Products', 'Address')->find($id);

        $message = '\n *'.__('trans.newOrders').' ('.env('APP_NAME').')* \n';
        $message .= '\n *Order Number :* '.$Order->id;

        if ($Order->Branch) {
            $message .= '\n *'.__('trans.branch').' :* '.$Order->Branch->title();
        }

        $message .= '\n *'.__('trans.name').' :* '.$Order->Client->name;
        $message .= '\n *'.__('trans.phone').' :* '.$Order->Client->phone;
        $message .= '\n *'.__('trans.time').' :* '.$Order->created_at;

        if ($Order->delivery_id == 1) {
            $message .= '\n *'.__('trans.region').' :* '.$Order->Address->region->title();
            if ($Order->Address->road) {
                $message .= '\n *'.__('trans.block').' :* '.$Order->Address->block;
            }
            if ($Order->Address->building_no) {
                $message .= '\n *'.__('trans.road').' :* '.$Order->Address->road;
            }
            if ($Order->Address->floor_no) {
                $message .= '\n *'.__('trans.building').' :* '.$Order->Address->building_no;
            }
            if ($Order->Address->apartment) {
                $message .= '\n *'.__('trans.floor').' :* '.$Order->Address->floor_no;
            }
            if ($Order->Address->type) {
                $message .= '\n *'.__('trans.apartment').' :* '.$Order->Address->apartment;
            }
            if ($Order->Address->additional_directions) {
                $message .= '\n *'.__('trans.type').' :* '.$Order->Address->type;
            }
            $message .= '\n *'.__('trans.additional_directions').' :* '.$Order->Address->additional_directions.' \n';
        } elseif ($Order->delivery_id == 2) {
            $message .= '\n *'.__('trans.type').' :* '.__('trans.Pickup').' \n';
        }

        $message .= '\n *'.__('trans.items').' :* ';
        foreach ($Order->Products as $Product) {
            $message .= '\n *'.__('trans.item').' :* '.strip_tags($Product->title());
            if ($Product->pivot->color_id) {
                $Color = Color($Product->pivot->color_id);
                $message .= '\n *'.__('trans.color').' :* '.$Color->title();
            }
            if ($Product->pivot->price) {
                $message .= '\n *'.__('trans.price').' :* '.$Product->pivot->price;
            }
            if ($Product->pivot->quantity) {
                $message .= '\n *'.__('trans.quantity').' :* '.$Product->pivot->quantity.'\n';
            }
        }
        $message .= '\n *'.__('trans.subTotal').' :* '.$Order->sub_total.' '.Country()->currancy_code;
        if ($Order->discount > 0) {
            $message .= '\n *'.__('trans.discount').' :* '.$Order->discount.' '.Country()->currancy_code;
        }
        if ($Order->vat > 0) {
            $message .= '\n *'.__('trans.vat').' :* '.$Order->vat.' '.Country()->currancy_code;
        }
        if ($Order->coupon > 0) {
            $message .= '\n *'.__('trans.coupon').' :* '.$Order->coupon.' '.Country()->currancy_code;
        }
        if ($Order->charge_cost > 0) {
            $message .= '\n *'.__('trans.delivery_charge').' :* '.$Order->charge_cost.' '.Country()->currancy_code;
        }
        $message .= '\n *'.__('trans.netTotal').' :* '.$Order->net_total.' '.Country()->currancy_code;

        $message .= '\n *Powered By Emcan Solutions* \n';

        WhatsApp::SendWhatsApp($Order->Client->Country->phone_code.$Order->Client->phone, $message);
        if (Setting('whatsapp')) {
            WhatsApp::SendWhatsApp(Setting('whatsapp'), $message);
        }
    }

    public static function GetToken()
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://emcan.bh/api/UltraCredentials',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_POSTFIELDS => 'token=zuvzajw7goMh20q5YVu0&domain='.$_SERVER['SERVER_NAME'],
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => [
                'content-type: application/x-www-form-urlencoded',
            ],
        ]);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        return json_decode($response);
    }

    public static function SendWhatsApp($numbers, $message)
    {
        $EmcanWhats = self::GetToken();
        $instance = $EmcanWhats->instance;
        $token = $EmcanWhats->token;
        if ($EmcanWhats->active) {
            $numbers = is_array($numbers) ? $numbers : [$numbers];
            foreach ($numbers as $number) {
                $number = str_replace('++', '+', $number);
                $curl = curl_init();
                curl_setopt_array($curl, [
                    CURLOPT_URL => 'https://api.ultramsg.com/'.$instance.'/messages/chat',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => "token=$token&to=$number&body=$message&priority=1&referenceId=",
                    CURLOPT_HTTPHEADER => [
                        'content-type: application/x-www-form-urlencoded',
                    ],
                ]);
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);
            }
        }
    }

} //end of class
