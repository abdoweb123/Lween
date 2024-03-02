<?php

namespace App\Http\Middleware;
use Closure;

class ClientIsActive
{
    public function handle($request, Closure $next)
    {
        if ( auth('client')->user()->status == 0 ) {
            auth('client')->logout();
            return redirect()->route('Client.login');
        }
        return $next($request);
    }

} //end of class