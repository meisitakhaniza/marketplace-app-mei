<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserIsSeller
{
    public function handle(Request $request, Closure $next)
    {
       if (!auth()->check() || auth()->user()->role !== 'seller') {
            abort(403, 'Akses ditolak. Kamu bukan seller.');
        }

        return $next($request);
    }
}
