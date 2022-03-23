<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->quyen === 1) { // Khi người dùng có quyen = 1 thì mới có quyền vào admin dashboard, phubui2703@gmail.com mk:123456
                return $next($request);
            }

            return redirect("admin/dangnhap");
        }

        return redirect("admin/dangnhap");
    }
}
