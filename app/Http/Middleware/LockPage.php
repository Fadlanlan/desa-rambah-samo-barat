<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Setting;

class LockPage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $target
     */
    public function handle(Request $request, Closure $next, string $target): Response
    {
        // Super admin bypasses all locks
        if (auth()->check() && auth()->user()->hasRole('super-admin')) {
            return $next($request);
        }

        $lockKey = "system_lock_{$target}";
        $isLocked = Setting::get($lockKey, '0');

        if ($isLocked === '1') {
            // Allow access to the homepage even when locked
            if ($request->is('/')) {
                return $next($request);
            }

            $message = $target === 'admin' ? 'Halaman Administrator sedang dikunci untuk pemeliharaan.' : 'Halaman Layanan Masyarakat sedang dikunci sementara.';

            return redirect('/')->with('error', $message);
        }

        return $next($request);
    }
}
