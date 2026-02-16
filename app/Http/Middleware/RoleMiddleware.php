<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $role
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        // Map super_admin to super-admin if necessary
        $roleCheck = ($role === 'super_admin' || $role === 'super-admin') ? 'super-admin' : $role;

        // Super Admin can access everything
        if ($user->hasRole('super-admin')) {
            return $next($request);
        }

        // Specific check for Super Admin area
        if ($roleCheck === 'super-admin' && !$user->hasRole('super-admin')) {
            // If they are admin, send to admin dashboard, else to home
            if ($user->hasRole('admin')) {
                return redirect()->route('dashboard')->with('error', 'Hanya Super Admin yang dapat mengakses halaman ini.');
            }
            return redirect('/')->with('error', 'Hanya Super Admin yang dapat mengakses halaman ini.');
        }

        // General role check
        if (!$user->hasRole($roleCheck)) {
            return redirect('/')->with('error', 'Anda tidak memiliki hak akses ke halaman tersebut.');
        }

        return $next($request);
    }
}
