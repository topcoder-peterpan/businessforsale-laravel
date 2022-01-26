<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class LastSeenUserActivity
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
        if (auth('customer')->check()) {
            $expiresAt = Carbon::now()->addMinutes(5);
            Cache::put('isOnline' . auth('customer')->id(), true, $expiresAt);

            //Last Seen
            Customer::where('id', auth('customer')->id())->update(['last_seen' => Carbon::now()]);
        }

        return $next($request);
    }
}
