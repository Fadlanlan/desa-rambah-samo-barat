<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Setting;
use Illuminate\Http\Request;

class CheckMenuAccessibility
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $route = $request->route();
        if (!$route) {
            return $next($request);
        }

        $routeName = $route->getName();

        if (str_starts_with($routeName, 'public.profil.')) {
            if (Setting::get('menu_public_profil', '1') !== '1') {
                return redirect()->route('home')->with('warning', 'Halaman Profil Desa sedang tidak aktif.');
            }
        }

        if (str_starts_with($routeName, 'public.berita.')) {
            if (Setting::get('menu_public_berita', '1') !== '1') {
                return redirect()->route('home')->with('warning', 'Halaman Berita sedang tidak aktif.');
            }
        }

        if (str_starts_with($routeName, 'public.surat.')) {
            if (Setting::get('menu_public_surat', '1') !== '1') {
                return redirect()->route('home')->with('warning', 'Layanan Surat sedang tidak aktif.');
            }
        }

        if (str_starts_with($routeName, 'public.antrian.')) {
            if (Setting::get('menu_public_antrian', '1') !== '1') {
                return redirect()->route('home')->with('warning', 'Layanan Antrian Online sedang tidak aktif.');
            }
        }

        if (str_starts_with($routeName, 'public.galeri.')) {
            if (Setting::get('menu_public_galeri', '1') !== '1') {
                return redirect()->route('home')->with('warning', 'Halaman Galeri Foto sedang tidak aktif.');
            }
        }

        if (str_starts_with($routeName, 'public.pengaduan.')) {
            if (Setting::get('menu_public_pengaduan', '1') !== '1') {
                return redirect()->route('home')->with('warning', 'Layanan Pengaduan Warga sedang tidak aktif.');
            }
        }

        return $next($request);
    }
}
