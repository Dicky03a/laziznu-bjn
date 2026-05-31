<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\QurbanRegistrationRequest;
use App\Models\QurbanHewan;
use App\Models\QurbanPeriod;
use App\Models\QurbanRegistration;
use App\Services\QurbanService;
use App\Services\WhatsAppReminderService;
use Illuminate\Http\Request;

class QurbanRegistrationController extends Controller
{
    public function __construct(
        protected QurbanService $qurbanService,
        protected WhatsAppReminderService $whatsAppReminderService,
    ) {}

    public function index(Request $request)
    {
        $periods = QurbanPeriod::orderByDesc('tahun')->get();

        $registrations = QurbanRegistration::with(['hewan', 'period', 'paymentConfirmation', 'confirmedBy'])
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
        $stats = $activePeriod ? $this->qurbanService->getRegistrationStats($activePeriod->id) : null;

        return view('admin.qurban.registrations.index', compact('registrations', 'periods', 'stats'));
    }

    public function create()
    {
        $periods = QurbanPeriod::active()->get();
        $hewans = QurbanHewan::with('period')
            ->whereHas('period', fn ($q) => $q->active())
            ->where('is_active', true)
            ->get();

        return view('admin.qurban.registrations.create', compact('periods', 'hewans'));
    }

    public function store(QurbanRegistrationRequest $request)
    {
        $hewan = QurbanHewan::findOrFail($request->validated('hewan_id'));

        $registration = $this->qurbanService->manualRegister(
            $request->validated(),
            $hewan,
            auth()->id()
        );

        return redirect()
            ->route('qurban.registrations.show', $registration)
            ->with('success', 'Pendaftaran qurban berhasil dibuat secara manual.');
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
            ->route('qurban.registrations.show', $registration)
            ->with('success', 'Pendaftaran berhasil dibatalkan.');
    }

    public function export(Request $request)
    {
        $filters = $request->only(['period_id', 'hewan_id', 'status', 'search']);
        $filename = 'laporan-qurban-laziznu-'.now()->format('Y-m-d_His').'.xlsx';

        return \Maatwebsite\Excel\Facades\Excel::download(
            new \App\Exports\Qurban\FilteredQurbanExport($filters),
            $filename
        );
    }

    public function reminder(QurbanRegistration $registration)
    {
        if ($registration->status !== 'pending') {
            return back()->with('error', 'Hanya dapat mengirim pengingat untuk registrasi yang masih pending.');
        }

        \App\Jobs\SendWhatsAppReminderJob::dispatch($registration, 'qurban');

        $reminder = $this->whatsAppReminderService->generateReminderQurban($registration);

        if (! $reminder['success']) {
            return back()->with('error', $reminder['message']);
        }

        return redirect($reminder['wa_link'])
            ->with('success', 'Silakan kirim pesan pengingat kepada peserta melalui WhatsApp.');
    }
}
