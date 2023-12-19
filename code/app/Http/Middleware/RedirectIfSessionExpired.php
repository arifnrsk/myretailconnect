<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Session;

class RedirectIfSessionExpired
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (!Session::has('lastActivityTime')) {
            Auth::guard('admin')->logout();
            return redirect('/login');
        }

        if (now()->diffInMinutes(Session::get('lastActivityTime')) > config('session.lifetime')) {
            Auth::guard('admin')->logout();
            return redirect('/login')->with('message', 'Session has expired due to inactivity');
        }

        Session::put('lastActivityTime', now());
        return $next($request);
    }
}
