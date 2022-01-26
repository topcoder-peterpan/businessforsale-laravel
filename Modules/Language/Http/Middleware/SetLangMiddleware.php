<?php

namespace Modules\Language\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLangMiddleware
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
        if (session()->has('lang')) {
            app()->setLocale(session()->get('lang'));
        } else {
            app()->setLocale('default');
        }

        return $next($request);
    }
}
