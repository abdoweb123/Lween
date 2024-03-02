<?php

namespace App\Http\Controllers\Client;

use App\Functions\WhatsApp;
use App\Http\Controllers\BasicController;
use App\Http\Requests\Client\ForgetRequest;
use App\Http\Requests\Client\LoginRequest;
use App\Http\Requests\Client\ProfileRequest;
use App\Http\Requests\Client\RegisterRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Modules\Client\Entities\Model as Client;
use Modules\Client\Requests\PhoneLength;
use Modules\Country\Entities\Country;

class AuthController extends BasicController
{
    /**** make login process ***/
    public function login(Request $request)
    {
//        return $request;
        //validation for (email or phone) depends on request
        $check = $this->checkValidatePhoneOrEmail($request);

        // Determine fields to include in the authentication attempt
        $fields = $this->checkPhoneOrEmail($check);

        if (auth('client')->attempt($request->only($fields))) {

            // Check user's status
            $client = auth('client')->user();
            if ($client->status == 0) {
                // User's status is inactive, log them out and update code and send it to him
                $client->update([
                    'verify_code' => WhatsApp::SendOTP($client->Country->phone_code.$request->phone)
                ]);
                auth('client')->logout();
                return redirect()->route("Client.otp", encrypt( $client->id));
            }


            // Authentication successful
            session()->flash('toast_message', ['type' => 'success', 'message' => __('trans.loginSuccessfully')]);
            return redirect()->route('Client.profile');
        }

        // Authentication failed
        session()->flash('toast_message', ['type' => 'error', 'message' => __('trans.'. $check .'PasswordIncorrect')]);
        return redirect()->back();
    }

    /**** make register process ***/
    public function register(RegisterRequest $request)
    {
        // check if this phone is already exists

        $this->validate($request, [
            'phone' => [
                new PhoneLength($request->input('country_code'),$max=8)
            ],
        ]);


        $country = Countries()->where('country_code',$request->country_code)->first();

        $client = Client::create([
            'country_id' => $country->id,
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'country_code' => $request->get('country_code'),
            'status' => 0,
            'password' => Hash::make($request->get('password')),
            'verify_code' => WhatsApp::SendOTP($country->phone_code.$request->phone)
        ]);
        return redirect()->route("Client.otp", encrypt( $client->id));
    }


    public function profile(ProfileRequest $request)
    {
        $client_id = client_id();
        Client::where('id', auth('client')->id())->update([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
        ]);
        DB::table('wishlist')->where('client_id', $client_id)->update(['client_id' => auth('client')->id()]);
        toast(__('trans.updatedSuccessfully'), 'success');

        return redirect()->route('Client.profile');
    }

    public function forget(ForgetRequest $request)
    {
        Client::where('phone', $request->phone)->update(['password' => Hash::make($request->password)]);
        $Client = Client::where('phone', $request->phone)->first();
        auth('client')->login($Client);
        toast(__('trans.loginSuccessfully'), 'success');

        return redirect()->route('Client.home');
    }

    public function logout()
    {
        if (auth('client')->check()) {
            auth('client')->logout();
        }
        toast(__('trans.logoutSuccessfully'), 'success');
        session()->flash('toast_message', ['type' => 'success', 'message' => __('trans.logoutSuccessfully')]);


        return redirect()->route('Client.home');
    }

    /*** called in login function ***/
    private function checkValidatePhoneOrEmail($request)
    {
        if ($request->phone){
            $check = 'phone';
            $this->validate($request, [
                'phone' => [
                    "required",
                    "exists:clients,phone",
                    'numeric',
                    new PhoneLength($request->input('country_code'),$max=8)
                ],
                'country_code'=>'required|exists:countries,country_code',
                'password' => 'required|min:6',
            ]);
        }
        else{
            $check = 'email';
            $this->validate($request, [
                'email' => [
                    "required",
                    "email",
                    "exists:clients,email",
                ],
                'password' => 'required|min:6',
            ]);
        }

        return $check;
    }

    /*** called in login function ***/
    private function checkPhoneOrEmail($check)
    {
        $fields = ['password'];

        // If $check is 'email', exclude 'country_code'
        if ($check == 'email') {
            $fields[] = $check;
        } else {
            $fields[] = 'country_code';
            $fields[] = $check;
        }

        return $fields;
    }



} //end of class
