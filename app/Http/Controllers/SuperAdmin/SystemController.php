<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Spatie\Activitylog\Models\Activity;

class SystemController extends Controller
{
    public function index()
    {
        $activities = Activity::with('causer')->latest()->paginate(20);
        $settings = [
            'nama_desa' => Setting::get('nama_desa'),
            'logo' => Setting::get('logo'),
            'lock_admin' => Setting::get('system_lock_admin', '0'),
            'lock_user' => Setting::get('system_lock_user', '0'),
        ];

        return view('superadmin.system', compact('activities', 'settings'));
    }

    public function lockPage(Request $request, $target)
    {
        $status = $request->status ? '1' : '0';
        Setting::set("system_lock_{$target}", $status, 'boolean', 'system');

        $message = $status === '1' ? "Halaman $target berhasil dikunci." : "Halaman $target berhasil dibuka.";
        return redirect()->back()->with('success', $message);
    }

    public function updateSettings(Request $request)
    {
        $request->validate([
            'nama_desa' => 'required|string|max:255',
        ]);

        Setting::set('nama_desa', $request->nama_desa);

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = 'logo_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('desa', $filename, 'public');
            Setting::set('logo', 'storage/desa/' . $filename);
        }

        return redirect()->back()->with('success', 'Pengaturan sistem berhasil diperbarui.');
    }

    public function backup()
    {
        // For demonstration, we'll just trigger a "success" message.
        // In a real scenario, we could use spatie/laravel-backup or a custom command.
        try {
            // Artisan::call('backup:run');
            return redirect()->back()->with('success', 'Pencadangan database berhasil dimulai (Simulasi).');
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal melakukan pencadangan: ' . $e->getMessage());
        }
    }
}
