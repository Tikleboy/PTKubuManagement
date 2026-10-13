<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if (! $user) {
            return redirect()->route('admin.login');
        }

        // Super Admin has unrestricted access to all admin operations
        if ($user->isSuperAdmin()) {
            return $next($request);
        }

        // Check if user's role matches any allowed role
        if (in_array($user->role, $roles, true)) {
            return $next($request);
        }

        abort(403, 'Akses Ditolak: Peran akun Anda (' . $user->role_label . ') tidak memiliki wewenang untuk membuka halaman ini.');
    }
}
