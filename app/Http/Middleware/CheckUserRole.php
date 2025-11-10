<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Jika user adalah admin, redirect ke dashboard admin
        if (session('user_role') === 'admin') {
            return redirect()->route('admin.dashboard')
                ->with('message', 'Admin dialihkan ke dashboard admin');
        }

        return $next($request);
    }
}