<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\LoginLog;

class IpLoggingMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            // Update last_login info on user if it changed significantly (e.g. daily or IP change)
            $user = Auth::user();
            $currentIp = $request->ip();
            $today = now()->startOfDay();

            if ($user->last_login_at < $today || $user->last_login_ip !== $currentIp) {
                $user->update([
                    'last_login_at' => now(),
                    'last_login_ip' => $currentIp,
                    'user_agent' => $request->userAgent()
                ]);

                // Create a log entry for new session
                LoginLog::create([
                    'user_id' => $user->id,
                    'email' => $user->email,
                    'ip_address' => $currentIp,
                    'user_agent' => $request->userAgent(),
                    'status' => 'success',
                    'login_at' => now(),
                ]);
            }
        }

        return $next($request);
    }
}
