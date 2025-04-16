<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): mixed
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $userRole = Auth::user()->role_idRole;

        if (!in_array($userRole, $roles)) {
            abort(403, 'Unauthorized Access');
        }

        return $next($request);
    }
}
