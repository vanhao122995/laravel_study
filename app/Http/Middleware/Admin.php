<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard('admin')->check() && Auth::guard('admin')->user()->username == 'admin') {
            return $next($request);
        }
        return redirect('admin/login');      
    }
}
