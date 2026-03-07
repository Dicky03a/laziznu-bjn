<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQurbanRegistrationRequest;
use App\Models\QurbanHewan;
use App\Models\QurbanPeriod;
use App\Services\QurbanService;
use Illuminate\Validation\ValidationException;

class QurbanController extends Controller
{
    public function __construct(
        protected QurbanService $qurbanService
    ) {}

    public function index()
    {
        $period = QurbanPeriod::active()->first();

        if (! $period) {
            return view('pages.public.qurban.index', [
                'period' => null,
                'hewanPatungan' => collect(),
                'hewanSendiri' => collect(),
            ]);
        }

        $allHewan = QurbanHewan::with('period')
            ->where('period_id', $period->id)
            ->active()
            ->withCount([
                'activeRegistrations as slot_active',
            ])
            ->get();

        $hewanPatungan = $allHewan->whereIn('jenis', QurbanHewan::JENIS_PATUNGAN)->values();
        $hewanSendiri = $allHewan->whereIn('jenis', QurbanHewan::JENIS_PERORANGAN)->values();

        return view('pages.public.qurban.index', compact('period', 'hewanPatungan', 'hewanSendiri'));
    }

    public function show(QurbanHewan $hewan)
    {
        abort_unless($hewan->is_active && $hewan->period->is_active, 404);

        $hewan->load('period');

        $pesertaTerdaftar = $hewan->activeRegistrations()
            ->select('id', 'nama_peserta', 'atas_nama', 'status', 'created_at')
            ->latest()
            ->get();

        $summary = $this->qurbanService->getSlotSummary($hewan);

        return view('pages.public.qurban.show', compact('hewan', 'pesertaTerdaftar', 'summary'));
    }

    public function store(StoreQurbanRegistrationRequest $request, QurbanHewan $hewan)
    {
        abort_unless($hewan->is_active && $hewan->period->is_active, 404);

        if (! $hewan->period->is_open) {
            return back()->with('error', 'Maaf, periode pendaftaran qurban sudah ditutup.');
        }

        try {
            $registration = $this->qurbanService->register($request->validated(), $hewan);
        } catch (ValidationException $e) {
            return back()
                ->withErrors($e->errors())
                ->withInput();
        }

        return redirect()
            ->route('qurban.payment', $registration->kode_registrasi)
            ->with('success', 'Pendaftaran qurban berhasil! Silakan lanjutkan pembayaran.');
    }
}
