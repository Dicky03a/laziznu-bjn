<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QurbanPeriod;
use App\Models\QurbanRegistration;
use App\Services\QurbanService;
use Illuminate\Http\Request;

class QurbanRegistrationController extends Controller
{
    public function __construct(
        protected QurbanService $qurbanService
    ) {}

    public function index(Request $request)
    {
        $periods = QurbanPeriod::orderByDesc('tahun')->get();

        $registrations = QurbanRegistration::with(['hewan', 'period', 'paymentConfirmation'])
            ->when($request->period_id, fn ($q) => $q->ofPeriod($request->period_id))
            ->when($request->status, fn ($q) => $q->where('status', $request->status))
            ->when($request->jenis, fn ($q) => $q->whereHas('hewan', fn ($h) => $h->ofJenis($request->jenis)))
            ->when($request->search, fn ($q) => $q->where(function ($q2) use ($request) {
                $q2->where('kode_registrasi', 'like', '%'.$request->search.'%')
                    ->orWhere('nama_peserta', 'like', '%'.$request->search.'%')
                    ->orWhere('email', 'like', '%'.$request->search.'%')
                    ->orWhere('telepon', 'like', '%'.$request->search.'%');
            }))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        // Summary stats
        $activePeriod = QurbanPeriod::active()->first();
        $stats = [];
        if ($activePeriod) {
            $stats = [
                'total_pending' => QurbanRegistration::ofPeriod($activePeriod->id)->pending()->count(),
                'total_confirmed' => QurbanRegistration::ofPeriod($activePeriod->id)->confirmed()->count(),
                'total_nominal' => QurbanRegistration::ofPeriod($activePeriod->id)->confirmed()->sum('total_bayar'),
            ];
        }

        return view('admin.qurban.registrations.index', compact('registrations', 'periods', 'stats'));
    }

    public function show(QurbanRegistration $registration)
    {
        $registration->load(['hewan.period', 'period', 'paymentConfirmation', 'confirmedBy']);
        $summary = $this->qurbanService->getSlotSummary($registration->hewan);

        return view('admin.qurban.registrations.show', compact('registration', 'summary'));
    }

    public function confirm(Request $request, QurbanRegistration $registration)
    {
        $request->validate([
            'catatan_admin' => ['nullable', 'string', 'max:500'],
        ]);

        if ($registration->status !== QurbanRegistration::STATUS_PENDING) {
            return back()->with('error', 'Registrasi ini sudah diproses sebelumnya.');
        }

        $this->qurbanService->confirm($registration, auth()->id(), $request->catatan_admin);

        return redirect()
            ->route('qurban.registrations.show', $registration)
            ->with('success', 'Pendaftaran qurban berhasil dikonfirmasi.');
    }

    public function cancel(Request $request, QurbanRegistration $registration)
    {
        $request->validate([
            'catatan_admin' => ['required', 'string', 'max:500'],
        ]);

        if ($registration->is_cancelled) {
            return back()->with('error', 'Registrasi ini sudah dibatalkan.');
        }

        $this->qurbanService->cancel($registration, auth()->id(), $request->catatan_admin);

        return redirect()
            ->route('admin.qurban.registrations.show', $registration)
            ->with('success', 'Pendaftaran berhasil dibatalkan.');
    }

    public function export(Request $request)
    {
        $registrations = QurbanRegistration::with(['hewan', 'period'])
            ->when($request->period_id, fn ($q) => $q->ofPeriod($request->period_id))
            ->when($request->status, fn ($q) => $q->where('status', $request->status))
            ->latest()
            ->get();

        $filename = 'qurban-laziznu-'.now()->format('Y-m-d').'.csv';

        return response()->stream(function () use ($registrations) {
            $file = fopen('php://output', 'w');
            fputcsv($file, [
                'Kode',
                'Tanggal',
                'Hewan',
                'Jenis',
                'Nama Peserta',
                'Atas Nama',
                'Telepon',
                'Email',
                'Total Bayar',
                'Status',
            ]);
            foreach ($registrations as $r) {
                fputcsv($file, [
                    $r->kode_registrasi,
                    $r->created_at->format('d/m/Y H:i'),
                    $r->hewan?->nama,
                    $r->hewan?->jenis_label,
                    $r->nama_peserta,
                    $r->atas_nama ?? '-',
                    $r->telepon ?? '-',
                    $r->email ?? '-',
                    $r->total_bayar,
                    $r->status_label,
                ]);
            }
            fclose($file);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ]);
    }
}
