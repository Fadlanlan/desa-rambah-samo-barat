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
            $message = $target === 'admin' ? 'Halaman Administrator sedang dikunci untuk pemeliharaan.' : 'Halaman Layanan Masyarakat sedang dikunci sementara.';

            // Only redirect if not already on the destination page to avoid loops
            if (!$request->is('/')) {
                return redirect('/')->with('error', $message);
            }

            // If already on homepage, just show the locked view or continue with a warning
            // For now, let's show a dedicated maintenance view to fulfill the "locked" requirement
            return response()->view('errors.locked', compact('message', 'target'), 503);
        }

        return $next($request);
    }
}
