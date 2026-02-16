<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Pelayanan\AntrianService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Exception;

class AntrianController extends Controller
{
    protected $antrianService;

    public function __construct(AntrianService $antrianService)
    {
        $this->antrianService = $antrianService;
    }

    /**
     * Display today's queue.
     */
    public function index(Request $request)
    {
        Gate::authorize('antrian.view');
        $stats = $this->antrianService->getDashboardStats();

        $filters = $request->only(['tanggal', 'status', 'search']);

        // We still want a default date for the UI datepicker
        $uiFilters = $filters;
        if (!isset($uiFilters['tanggal'])) {
            $uiFilters['tanggal'] = now()->toDateString();
        }

        // But for the actual query, if no date is explicitly picked, 
        // maybe we show all pending items regardless of date?
        // Or we show today's and all future pending items.
        // Let's stick to "If no date picked, show all pending items".

        $items = $this->antrianService->getQueueList(50, $filters);

        return view('admin.antrian.index', compact('stats', 'items', 'filters', 'uiFilters'));
    }

    /**
     * Call next visitor.
     */
    public function callNext()
    {
        Gate::authorize('antrian.manage');
        try {
            $antrian = $this->antrianService->callNext(auth()->id());
            if (!$antrian) {
                return back()->with('info', 'Tidak ada antrian menunggu.');
            }
            return back()->with('success', 'Memanggil antrian: ' . $antrian->nomor_antrian);
        }
        catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Complete service.
     */
    public function complete($id)
    {
        Gate::authorize('antrian.manage');
        $this->antrianService->completeService($id);
        return back()->with('success', 'Layanan selesai.');
    }

    /**
     * Cancel queue.
     */
    public function cancel($id)
    {
        Gate::authorize('antrian.manage');
        $this->antrianService->cancelQueue($id);
        return back()->with('success', 'Antrian dibatalkan.');
    }
    /**
     * Clear all queue data.
     */
    public function clearAll()
    {
        Gate::authorize('antrian.manage');

        try {
            // Assuming Antrian model is available via typical means or service
            // Since service manages logic, let's try to use service if possible, or direct model if service method missing
            // For now, let's use direct DB/Model call as we are in controller and it's a bulk action
            // We need to know the model class. AntrianService uses App\Models\Antrian

            \App\Models\Antrian::truncate();

            return redirect()->route('antrian.index')
                ->with('success', 'Seluruh data antrian berhasil dibersihkan.');
        }
        catch (Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
