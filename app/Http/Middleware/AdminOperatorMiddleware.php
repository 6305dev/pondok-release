<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminOperatorMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->guard('web')->check()) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = auth()->guard('web')->user();

        if (!in_array($user->role_id, [1, 4])) {
            return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}