<?php

namespace App\Http\Controllers\Client;

use App\Functions\Upload;
use App\Http\Controllers\BasicController;
use Exception;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;
use Modules\Client\Entities\Model as Client;

class SocialiteController extends BasicController
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $client = Socialite::driver('google')->client();
            $findclient = Client::where('google_id', $client->id)->first();
            if ($findclient) {
                Auth('client')->login($findclient);

                return redirect()->route('messages');
            } else {
                $imagePath = Upload::StoreUrlImage($client->image, 'clients-image') ?? 'logo.png';
                $newClient = Client::create([
                    'name' => $client->name,
                    'email' => $client->email,
                    'image' => $imagePath,
                    'image' => $imagePath,
                    'google_id' => $client->id,
                    'password' => encrypt('password'),
                ]);
                DB::table('ch_messages')->insert([
                    'id' => mt_rand(9, 999999999) + time(),
                    'type' => 'client',
                    'to_id' => $newClient->id,
                    'from_id' => 1,
                    'body' => 'Hi',
                ]);
                Auth('client')->login($newClient);

                return redirect()->route('messages');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
