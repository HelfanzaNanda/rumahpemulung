<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard('client')->check()) {
            return redirect('client');
        }
        if (Auth::guard('superadmin')->check()) {
            return redirect('superadmin');
        }
        if (Auth::guard('lapak')->check()) {
            return redirect('lapak');
        }
        if (Auth::guard('pemulung')->check()) {
            return redirect('pemulung');
        }

        return $next($request);
    }
}
