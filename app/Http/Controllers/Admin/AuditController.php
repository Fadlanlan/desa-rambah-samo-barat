<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Spatie\Activitylog\Models\Activity;

class AuditController extends Controller
{
    /**
     * Display chronological audit log.
     */
    public function index(Request $request)
    {
        Gate::authorize('log.view');
        $query = Activity::with('causer')->latest();

        if ($request->filled('log_name')) {
            $query->where('log_name', $request->log_name);
        }

        if ($request->filled('causer_id')) {
            $query->where('causer_id', $request->causer_id);
        }

        if ($request->filled('event')) {
            $query->where('event', $request->event);
        }

        $activities = $query->paginate(20)->withQueryString();

        return view('admin.audit.index', compact('activities'));
    }

    /**
     * Show detail of an activity.
     */
    public function show($id)
    {
        Gate::authorize('log.view');
        $activity = Activity::findOrFail($id);
        return view('admin.audit.show', compact('activity'));
    }
    /**
     * Remove all activity logs.
     */
    public function destroyAll()
    {
        Gate::authorize('log.view'); // Should ideally be log.delete, but using log.view as per plan/existing gates

        try {
            Activity::truncate();
            return redirect()->route('audit.index')
                ->with('success', 'Seluruh log aktivitas berhasil dibersihkan.');
        }
        catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
