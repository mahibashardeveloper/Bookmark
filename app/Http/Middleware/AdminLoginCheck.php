<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminLoginCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $path = \Illuminate\Support\Facades\Request::route()->getName();
        if (Auth::guard('admins')->check()) {
            if($path == 'lvs.admin.auth') {
                return redirect()->route('lvs.admin.any', 'dashboard');
            } else {
                return $next($request);
            }
        } else {
            if($path == 'lvs.admin.auth') {
                return $next($request);
            } else {
                return redirect()->route('lvs.admin.auth', 'login');
            }
        }

    }
}
