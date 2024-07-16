<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class OnlyClientOrGuest
{
    public function handle($request, Closure $next)
    {
        // Jika user belum login, izinkan akses
        if (!Auth::check()) {
            return $next($request);
        }

        // Jika user sudah login sebagai client, izinkan akses
        if (Auth::check() && Auth::user()->role_id == 2) {
            return $next($request);
        }

        // Selain itu, arahkan ke halaman lain (misalnya dashboard admin)
        return redirect('admin/dashboard');
    }
}
