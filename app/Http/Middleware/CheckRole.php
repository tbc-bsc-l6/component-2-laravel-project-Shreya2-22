<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            abort(403, 'Unauthorized');
        }
        
        $userRole = Auth::user()->userRole->role;
        
        // Check if user's role matches any of the allowed roles
        if (!in_array($userRole, $roles)) {
            abort(403, 'Unauthorized');
        }
        
        return $next($request);
    }
}