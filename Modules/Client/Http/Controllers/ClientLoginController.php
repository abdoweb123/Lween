<?php

namespace Modules\Client\Http\Controllers;

use App\Http\Controllers\BasicController;
use App\Functions\WhatsApp;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Client\Entities\Model as Client;
//use App\Rules\PhoneLength;
use Modules\Client\Requests\PhoneLength;


class ClientLoginController extends BasicController
{
    use AuthenticatesUsers;

    // protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest:client')->except('logout');
    }

    protected function guard()
    {
        return Auth::guard('client');
    }

    public function showLoginForm()
    {
        session(['link' => url()->previous()]);
        return view('Client.login');

    }

    public function showOtp($id, Request $request)
    {
        return view('Client.otp', ['id' =>decrypt($id)]);
    }

    public function forgetPassword()
    {
        //    dd($id);
        return view('Client.forgePassword');

    }

    public function OTPRestPage($id)
    {
        //    dd(decrypt( $id));
        return view('Client.otpRest',['id' => decrypt( $id)]);

    }

    public function OTPRestPassword(Request $request)
    {
        $validator = validator($request->all(), [
            'phone' => ["required","exists:clients,phone",'numeric',new PhoneLength($request->input('country_code'),$max=8)],
            'country_code'=>'required|exists:clients,country_code'
        ]);
        if ($validator->fails()) {
            // dd(1);
            return redirect()->back()->withInput()->withErrors($validator->getMessageBag());

        }
        $client = Client::where('phone', $request->phone)->first();
        $client->update([
            'verify_code' => WhatsApp::SendOTP($request->phone_code.$request->phone)
        ]);
        //send sms

        return redirect(route('client.OTPRestPage',encrypt($client->id)));

    }

    public function restPassword($id, Request $request)
    {
        // dd($id);
        $validator = validator($request->all(), [
            'verify_code' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->getMessageBag());

        }
        $client = Client::where('id', decrypt($id))->first();
        $verify_code = Client::where('id', decrypt($id))->first()->verify_code;
        // dd($verify_code);
        if ($verify_code == $request->verify_code) {
            // dd(2);
            return redirect(route('client.restPasswordPage',encrypt($client->id)));
        } else {
// dd(1);
            return redirect()->back()->with('wrong', 'wrong');
        }


    }

    public function restPasswordPage($id)
    {
        //    dd(decrypt( $id));
        return view('Client.restPassword',['id' => decrypt( $id)]);

    }

    public function clientRest($id, Request $request)
    {
        // dd($id);
        $this->validate($request, [
            'password' => 'required|min:6|confirmed',
        ]);

        $client = Client::where('id', $id)->first();
        $client->update([
            "password" => bcrypt($request->password)
        ]);
        Auth::guard('client')->login($client);
        return redirect('/');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'phone' => ["required",
                "exists:clients,phone",
                'numeric',new PhoneLength($request->input('country_code'),$max=8)],
            'country_code'=>'required|exists:clients,country_code',
            'password' => 'required|min:6',
        ]);
        if (Auth::guard('client')->attempt(['phone' => $request['phone'], 'password' => $request['password'], 'status' => 1], $request->remember)) {
            return redirect()->intended(route('Client.home'));
            // return redirect(session('link'));
        }
        return redirect()->back()->withInput($request->only('phone', 'remember'));
    }

    public function showRegisterForm()
    {
        // dd(1);

        return view('Client.register');
    }

    public function verifyOtp($id, Request $request)
    {
        // dd($id);
        $validator = validator($request->all(), [
            'verify_code' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->getMessageBag());

        }
        $client = Client::where('id',decrypt($id) )->first();
        $verify_code = Client::where('id', decrypt($id))->first()->verify_code;
        if ($verify_code == $request->verify_code) {
            $client->update([
                'status'=>1,
            ]);
            Auth::guard('client')->login($client);

            // Authentication successful
            session()->flash('toast_message', ['type' => 'success', 'message' => __('trans.loginSuccessfully')]);
            return redirect()->route('Client.profile');
        } else {

            // Authentication failed
            session()->flash('toast_message', ['type' => 'error', 'message' => __('trans.verification_code_incorrect_send_again')]);
            return redirect()->back();
        }

    }


    public function Resend(Request $request)
    {
        $Client = Client::where('id', decrypt($request->ssh))->first();
        $Client->update([
            'verify_code' => WhatsApp::SendOTP($Client->Country->phone_code.$Client->phone)
        ]);
    }


    public function register(Request $request)
    {

        $validator = validator($request->all(), [
            'name' => 'required|string',
            'phone' =>["required",'unique:clients,phone','numeric',new PhoneLength($request->input('country_code'),$max=8)],
            'password' => 'required|min:6|confirmed',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->getMessageBag());

        }
        // dd($request->all());

        $client = Client::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'phone_code' => $request->phone_code,
            'country_code' => $request->country_code,
            'password' => bcrypt($request->password),
            'confirm_password' => bcrypt($request->password_confirmation),
            'verify_code' => WhatsApp::SendOTP($request->phone_code.$request->phone)
        ]);
        //    dd($client->id);
        //send sms with created user and his veryfiy code
        return redirect(route("client.otp", encrypt( $client->id)));
    }


    public function username()
    {
        return 'phone';
    }

    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password') + ['status' => 1];
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return redirect()->route('Client.login');
    }


}//end of class