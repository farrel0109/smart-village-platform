<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        // Jika user menggunakan kolom relasi ke role_id
        $userRole = $user->role->name ?? null;

        if (in_array($userRole, $roles)) {
            return $next($request);
        }

        return abort(403, 'Unauthorized');
    }
}
