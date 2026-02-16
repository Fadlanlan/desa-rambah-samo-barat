<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LoginLog; // Assuming we use LoginLog or generic activity log
use Symfony\Component\HttpFoundation\Response;

class LogIpAddress
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            // Option 1: Log every request (expensive, maybe too much)
            // Option 2: Update last known IP on user or separate log table

            // For now, let's just ensure we have the IP available in the session or log it once per session
            if (!session()->has('logged_ip')) {
                // Here you would typically log to a database table
                // For this implementation, we'll just store it in session to confirm middleware works
                session(['logged_ip' => $request->ip()]);
            }
        }

        return $next($request);
    }
}
