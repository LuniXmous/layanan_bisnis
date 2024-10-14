<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdminOrWadir4
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        // Assuming 'role' is the field in your user model
        if (Auth::check() && (Auth::user()->role->alias === 'admin' || Auth::user()->role->alias === 'wadir4')) {
            return $next($request);
        }

        return response()->json(['message' => 'Forbidden'],403);
    }
}
