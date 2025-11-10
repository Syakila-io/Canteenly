<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectIfAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (session('user_role') === 'admin') {
            return redirect()->route('admin.dashboard')
                ->with('message', 'Admin dialihkan ke dashboard admin');
        }

        return $next($request);
    }
}