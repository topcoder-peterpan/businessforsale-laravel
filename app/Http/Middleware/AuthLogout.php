<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthLogout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('super_admin')->check() || Auth::guard('customer')->check()) {
            Auth::guard('super_admin')->logout();
            Auth::guard('customer')->logout();
        }
        return $next($request);
    }
}
