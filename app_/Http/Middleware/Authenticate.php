<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
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
