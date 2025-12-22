<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || Auth::user()->user_role_id !== 1) {
            return redirect('/login')->with('error', 'Access denied.');
        }
        return $next($request);
    }
}