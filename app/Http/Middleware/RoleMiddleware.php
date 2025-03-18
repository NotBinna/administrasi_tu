<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): mixed
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Ambil idRole user yang sedang login
        $userRole = Auth::user()->role_idRole; // Sesuaikan dengan nama kolom di tabel User

        // Cek apakah idRole user sesuai dengan yang diizinkan
        if (!in_array($userRole, $roles)) {
            abort(403, 'Unauthorized Access');
        }

        return $next($request);
    }
}
