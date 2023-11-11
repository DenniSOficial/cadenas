<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminAuthenticated
{

    public function handle($request, Closure $next, $guard = "admin")
    {
        if (!Auth::guard($guard)->check()) {
            return redirect()->route('login');
        }

        if (!Session::has('guard')) {
            Session::flush();
            Auth::guard($guard)->logout();
            return redirect()->route('login');
        }

        return $next($request);

    }
}
