<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;

class Site
{
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard('user')->check()) {
            return $next($request);
        }
        return redirect('login')->with('message', 'Vui lòng đăng nhập để tiếp tục');      
    }
}
