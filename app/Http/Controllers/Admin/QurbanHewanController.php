<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Qurban\StoreQurbanHewanRequest;
use App\Models\QurbanHewan;
use App\Models\QurbanPeriod;
use App\Services\QurbanService;
use Illuminate\Http\Request;

class QurbanHewanController extends Controller
{
      public function __construct(
            protected QurbanService $qurbanService
      ) {}

      public function index(Request $request)
      {
            $periods = QurbanPeriod::orderByDesc('tahun')->get();

            $hewan = QurbanHewan::with('period')
                  ->when($request->period_id, fn($q) => $q->where('period_id', $request->period_id))
                  ->when($request->jenis, fn($q) => $q->ofJenis($request->jenis))
                  ->withCount([
                        'registrations as slot_pending'   => fn($q) => $q->pending(),
                        'registrations as slot_confirmed'  => fn($q) => $q->confirmed(),
                        'registrations as slot_active'     => fn($q) => $q->active(),
                  ])
                  ->withSum(['registrations as terkumpul' => fn($q) => $q->confirmed()], 'total_bayar')
                  ->latest()
                  ->paginate(15)
                  ->withQueryString();

            return view('admin.qurban.hewan.index', compact('hewan', 'periods'));
      }

      public function create(Request $request)
      {
            $periods = QurbanPeriod::orderByDesc('tahun')->get();
            $selectedPeriod = $request->period_id
                  ? QurbanPeriod::find($request->period_id)
                  : QurbanPeriod::active()->first();

            return view('admin.qurban.hewan.create', compact('periods', 'selectedPeriod'));
      }

      public function store(StoreQurbanHewanRequest $request)
      {
            $validated = $request->validated();
            $validated['is_active'] = $request->boolean('is_active', true);

            // Auto-set max_peserta dan harga_per_slot dari jenis
            $validated = QurbanHewan::buildFromJenis($validated);

            if ($request->hasFile('gambar')) {
                  $validated['gambar'] = $request->file('gambar')
                        ->store('qurban/hewan', 'public');
            }

            $validated['period_id'] = $request->period_id;
            QurbanHewan::create($validated);

            return redirect()
                  ->route('qurban.binatang.index')
                  ->with('success', 'Hewan qurban berhasil ditambahkan.');
      }

      public function edit(QurbanHewan $hewan)
      {
            $periods = QurbanPeriod::orderByDesc('tahun')->get();
            $summary = $this->qurbanService->getSlotSummary($hewan);

            return view('admin.qurban.hewan.create', compact('hewan', 'periods', 'summary'));
      }

      public function update(StoreQurbanHewanRequest $request, QurbanHewan $hewan)
      {
            $validated              = $request->validated();
            $validated['is_active'] = $request->boolean('is_active');
            $validated['period_id'] = $request->period_id;

            // Recalculate slot & harga jika jenis atau harga berubah
            $validated = QurbanHewan::buildFromJenis($validated);

            if ($request->hasFile('gambar')) {
                  if ($hewan->gambar) {
                        \Storage::disk('public')->delete($hewan->gambar);
                  }
                  $validated['gambar'] = $request->file('gambar')
                        ->store('qurban/hewan', 'public');
            }

            $hewan->update($validated);

            return redirect()
                  ->route('qurban.hewan.index')
                  ->with('success', 'Data hewan berhasil diperbarui.');
      }

      public function destroy(QurbanHewan $hewan)
      {
            if ($hewan->confirmedRegistrations()->exists()) {
                  return back()->with('error', 'Tidak dapat menghapus hewan yang memiliki pendaftar terkonfirmasi.');
            }

            if ($hewan->gambar) {
                  \Storage::disk('public')->delete($hewan->gambar);
            }

            $hewan->delete();

            return redirect()
                  ->route('qurban.binatang.index')
                  ->with('success', 'Hewan berhasil dihapus.');
      }

      public function toggleActive(QurbanHewan $hewan)
      {
            $hewan->update(['is_active' => ! $hewan->is_active]);

            return back()->with('success', 'Status hewan diperbarui.');
      }
}
