<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Surat;
use App\Models\JenisSurat;
use App\Models\Penduduk;
use App\Services\Pelayanan\SuratService;
use App\Http\Requests\StoreSuratRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SuratController extends Controller
{
    protected $service;

    public function __construct(SuratService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        Gate::authorize('surat.view');

        $filters = $request->only(['status', 'jenis_surat_id', 'search']);
        $items = $this->service->getPaginated(15, $filters);
        $jenisSurat = JenisSurat::where('is_active', true)->get();

        return view('admin.surat.index', compact('items', 'jenisSurat'));
    }

    public function create()
    {
        Gate::authorize('surat.create');

        $jenisSurat = JenisSurat::where('is_active', true)->orderBy('urutan')->get();
        $penduduk = Penduduk::orderBy('nama')->get();

        return view('admin.surat.create', compact('jenisSurat', 'penduduk'));
    }

    public function store(StoreSuratRequest $request)
    {
        Gate::authorize('surat.create');

        $this->service->submitRequest($request->validated());

        return redirect()->route('surat.index')
            ->with('success', 'Permohonan surat berhasil dibuat.');
    }

    public function show(int $id)
    {
        Gate::authorize('surat.view');

        $item = $this->service->findByIdOrFail($id);

        return view('admin.surat.show', compact('item'));
    }

    /**
     * Process the letter (Assign number and change status to 'diproses')
     */
    public function process(int $id)
    {
        Gate::authorize('surat.approve');

        try {
            $this->service->process($id, Auth::id());
            return redirect()->back()->with('success', 'Surat berhasil diproses dan nomor surat telah di-generate.');
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Reject the letter permohonan.
     */
    public function reject(Request $request, int $id)
    {
        Gate::authorize('surat.approve');

        $request->validate([
            'alasan_penolakan' => 'required|string',
        ]);

        $this->service->reject($id, $request->alasan_penolakan, Auth::id());

        return redirect()->route('surat.index')->with('success', 'Permohonan surat ditolak.');
    }

    /**
     * Mark as finished/signed.
     */
    public function finish(int $id)
    {
        Gate::authorize('surat.approve');

        try {
            $this->service->finish($id, Auth::id());
            return redirect()->back()->with('success', 'Status surat diperbarui menjadi selesai.');
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Download letter as PDF.
     */
    public function download(int $id)
    {
        Gate::authorize('surat.view');

        try {
            /** @var Surat $surat */
            $surat = $this->service->findByIdOrFail($id);

            // If file already exists in storage, serve it
            if ($surat->file_pdf && Storage::disk('public')->exists($surat->file_pdf)) {
                return Storage::disk('public')->download($surat->file_pdf, str_replace('/', '-', $surat->nomor_surat) . '.pdf');
            }

            // Fallback: generate on the fly
            $pdf = $this->service->generatePdf($id);
            $filename = str_replace('/', '-', $surat->nomor_surat) . '.pdf';

            return $pdf->download($filename);
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy(int $id)
    {
        Gate::authorize('surat.delete');

        $this->service->delete($id);

        return redirect()->route('surat.index')
            ->with('success', 'Data permohonan surat dihapus.');
    }
}
