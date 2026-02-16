<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_admins' => User::role('admin')->count(),
            'recent_activities' => Activity::latest()->take(5)->get(),
            'lock_status' => [
                'admin' => Setting::get('system_lock_admin', '0') === '1',
                'user' => Setting::get('system_lock_user', '0') === '1',
            ],
            'village_info' => Setting::get('nama_desa', 'Desa Rambah Samo Barat')
        ];

        return view('superadmin.dashboard', compact('stats'));
    }
}
