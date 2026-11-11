<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminOnlyMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->guard('web')->check()) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = auth()->guard('web')->user();

        if ($user->role_id !== 1) {
            return redirect('/admin/dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}
