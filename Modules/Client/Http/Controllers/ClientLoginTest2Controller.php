<?php

namespace Modules\Client\Http\Controllers;

use App\Http\Controllers\BasicController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientLoginTest2Controller extends BasicController
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest:client')->except('logout');
    }

    public function showLoginForm()
    {
        return view('Client.login');
    }

    protected function guard()
    {
        return Auth::guard('client');
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

} //end of class
