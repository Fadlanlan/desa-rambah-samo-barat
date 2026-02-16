<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Session\Store;

class SessionTimeoutMiddleware
{
    protected $session;
    protected $timeout = 1800; // 30 minutes in seconds

    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return $next($request);
        }

        $lastActivity = $this->session->get('last_activity');

        if ($lastActivity && (time() - $lastActivity > $this->timeout)) {
            $this->session->forget('last_activity');
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->with('status', 'Sesi Anda telah berakhir. Silakan login kembali.');
        }

        $this->session->put('last_activity', time());

        return $next($request);
    }
}
