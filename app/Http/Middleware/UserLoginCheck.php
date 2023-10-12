<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserLoginCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $path = \Illuminate\Support\Facades\Request::route()->getName();
        if (Auth::guard('users')->check()) {
            if($path == 'lvs.user.auth') {
                return redirect()->route('lvs.user.any', 'dashboard');
            } else {
                return $next($request);
            }
        } else {
            if($path == 'lvs.user.auth') {
                return $next($request);
            } else {
                return redirect()->route('lvs.user.auth', 'login');
            }
        }

    }
}
