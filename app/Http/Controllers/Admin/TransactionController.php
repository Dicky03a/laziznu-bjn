<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TransactionRequest;
use App\Models\Kecamatan;
use App\Models\Program;
use App\Models\Transaction;
use App\Services\TransactionService;
use App\Services\WhatsAppReminderService;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function __construct(
        protected TransactionService $transactionService,
        protected WhatsAppReminderService $whatsAppReminderService,
    ) {}

    public function index(Request $request)
    {
        $transactions = Transaction::query()
            ->with(['program', 'paymentConfirmation', 'kecamatan', 'desa'])
            ->when($request->types, function ($q) use ($request) {
                $q->where(function ($sub) use ($request) {
                    foreach ($request->types as $type) {
                        if ($type === 'zakat') {
                            $sub->orWhere(fn ($q2) => $q2->where('type', 'zakat')->whereNull('program_id'));
                        } elseif ($type === 'zakat_program') {
                            $sub->orWhere(fn ($q2) => $q2->where('type', 'zakat')->whereNotNull('program_id'));
                        } else {
                            $sub->orWhere('type', $type);
                        }
                    }
                });
            })
            ->when($request->status, fn ($q) => $q->withStatus($request->status))
            ->when($request->search, fn ($q) => $q->where(function ($q2) use ($request) {
                $q2->where('kode_transaksi', 'like', '%'.$request->search.'%')
                    ->orWhere('nama_donatur', 'like', '%'.$request->search.'%')
                    ->orWhere('email', 'like', '%'.$request->search.'%');
            }))
            ->when($request->tanggal_dari, fn ($q) => $q->whereDate('created_at', '>=', $request->tanggal_dari))
            ->when($request->tanggal_sampai, fn ($q) => $q->whereDate('created_at', '<=', $request->tanggal_sampai))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        // Pass request filters to service for dynamic stats
        $filters = [
            'types' => $request->types,
            'status' => $request->status,
            'search' => $request->search,
            'tanggal_dari' => $request->tanggal_dari,
            'tanggal_sampai' => $request->tanggal_sampai,
        ];
        $stats = $this->transactionService->getTransactionStats($filters);

        return view('admin.transactions.index', compact('transactions', 'stats'));
    }

    public function create()
    {
        $programs = Program::active()->get();
        $kecamatans = Kecamatan::orderBy('nama')->get();

        return view('admin.transactions.create', compact('programs', 'kecamatans'));
    }

    public function store(TransactionRequest $request)
    {
        $transaction = $this->transactionService->manualCreate(
            $request->validated(),
            auth()->id()
        );

        return redirect()
            ->route('transactions.show', $transaction)
            ->with('success', 'Transaksi berhasil dibuat secara manual.');
    }

    public function show(Transaction $transaction)
    {
        $transaction->load(['program', 'paymentConfirmation', 'confirmedBy', 'kecamatan', 'desa']);

        return view('admin.transactions.show', compact('transaction'));
    }

    public function confirm(Request $request, Transaction $transaction)
    {
        $request->validate([
            'catatan_admin' => ['nullable', 'string', 'max:500'],
        ]);

        if ($transaction->status !== Transaction::STATUS_PENDING) {
            return back()->with('error', 'Transaksi ini sudah diproses.');
        }

        if (! $transaction->paymentConfirmation) {
            return back()->with('error', 'Donatur belum mengirim bukti transfer. Konfirmasi transaksi tidak dapat diproses sampai ada bukti dari donatur.');
        }

        $this->transactionService->confirm(
            $transaction,
            auth()->id(),
            $request->catatan_admin
        );

        return redirect()
            ->route('transactions.show', $transaction)
            ->with('success', 'Transaksi berhasil dikonfirmasi.');
    }

    public function reject(Request $request, Transaction $transaction)
    {
        $request->validate([
            'catatan_admin' => ['required', 'string', 'max:500'],
        ]);

        if ($transaction->status !== Transaction::STATUS_PENDING) {
            return back()->with('error', 'Transaksi ini sudah diproses.');
        }

        $this->transactionService->reject(
            $transaction,
            auth()->id(),
            $request->catatan_admin
        );

        return redirect()
            ->route('transactions.show', $transaction)
            ->with('success', 'Transaksi ditolak.');
    }

    public function export(Request $request)
    {
        $transactions = Transaction::query()
            ->with(['program', 'kecamatan', 'desa'])
            ->when($request->types, function ($q) use ($request) {
                $q->where(function ($sub) use ($request) {
                    foreach ($request->types as $type) {
                        if ($type === 'zakat') {
                            $sub->orWhere(fn ($q2) => $q2->where('type', 'zakat')->whereNull('program_id'));
                        } elseif ($type === 'zakat_program') {
                            $sub->orWhere(fn ($q2) => $q2->where('type', 'zakat')->whereNotNull('program_id'));
                        } else {
                            $sub->orWhere('type', $type);
                        }
                    }
                });
            })
            ->when($request->status, fn ($q) => $q->withStatus($request->status))
            ->when($request->tanggal_dari, fn ($q) => $q->whereDate('created_at', '>=', $request->tanggal_dari))
            ->when($request->tanggal_sampai, fn ($q) => $q->whereDate('created_at', '<=', $request->tanggal_sampai))
            ->latest()
            ->get();

        $filename = 'transaksi-laziznu-'.now()->format('Y-m-d').'.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($transactions) {

            $file = fopen('php://output', 'w');

            fputcsv($file, [
                'Kode',
                'Tanggal',
                'Jenis',
                'Program',
                'Nama',
                'Email',
                'Telepon',
                'Jumlah (Rp)',
                'Status',
                'Dikonfirmasi',
            ]);

            $totalDana = 0;
            $totalDSKL = 0;
            $totalInfaqSodakoh = 0;
            $totalZakat = 0;
            $totalZakatProgram = 0;

            foreach ($transactions as $t) {

                // Label Jenis
                $typeLabel =
                    $t->type === 'infaq'
                    ? 'DSKL'
                    : (
                        $t->type === 'donasi'
                        ? 'Infaq dan Sodakoh'
                        : (
                            $t->type === 'zakat' && $t->program_id
                            ? 'Zakat Program'
                            : (
                                $t->type === 'zakat'
                                ? 'Zakat'
                                : $t->type_label
                            )
                        )
                    );

                // Total keseluruhan
                $totalDana += $t->jumlah;

                // Total DSKL
                if ($t->type === 'infaq') {
                    $totalDSKL += $t->jumlah;
                }

                // Total Infaq & Sodakoh
                if ($t->type === 'donasi') {
                    $totalInfaqSodakoh += $t->jumlah;
                }

                // Total Zakat Program
                if ($t->type === 'zakat' && $t->program_id) {
                    $totalZakatProgram += $t->jumlah;
                }

                // Total Zakat Biasa
                if ($t->type === 'zakat' && ! $t->program_id) {
                    $totalZakat += $t->jumlah;
                }

                fputcsv($file, [
                    $t->kode_transaksi,
                    $t->created_at->format('d/m/Y H:i'),
                    $typeLabel.($t->subtype ? " ({$t->subtype})" : ''),
                    $t->program?->nama ?? '-',
                    $t->nama_tampil,
                    $t->email ?? '-',
                    $t->telepon ?? '-',
                    'Rp '.number_format($t->jumlah, 0, ',', '.'),
                    $t->status_label,
                    $t->confirmed_at?->format('d/m/Y H:i') ?? '-',
                ]);
            }

            fputcsv($file, []);

            fputcsv($file, [
                '',
                '',
                '',
                '',
                '',
                '',
                'TOTAL DANA DSKL',
                'Rp '.number_format($totalDSKL, 0, ',', '.'),
            ]);

            fputcsv($file, [
                '',
                '',
                '',
                '',
                '',
                '',
                'TOTAL DANA INFAQ & SODAKOH',
                'Rp '.number_format($totalInfaqSodakoh, 0, ',', '.'),
            ]);

            fputcsv($file, [
                '',
                '',
                '',
                '',
                '',
                '',
                'TOTAL DANA ZAKAT',
                'Rp '.number_format($totalZakat, 0, ',', '.'),
            ]);

            fputcsv($file, [
                '',
                '',
                '',
                '',
                '',
                '',
                'TOTAL DANA ZAKAT PROGRAM',
                'Rp '.number_format($totalZakatProgram, 0, ',', '.'),
            ]);

            fputcsv($file, [
                '',
                '',
                '',
                '',
                '',
                '',
                'TOTAL KESELURUHAN',
                'Rp '.number_format($totalDana, 0, ',', '.'),
            ]);

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function reminder(Transaction $transaction)
    {
        if ($transaction->status !== 'pending') {
            return back()->with('error', 'Hanya dapat mengirim pengingat untuk transaksi yang masih pending.');
        }

        \App\Jobs\SendWhatsAppReminderJob::dispatch($transaction, 'transaction');

        $reminder = $this->whatsAppReminderService->generateReminder($transaction);

        if (! $reminder['success']) {
            return back()->with('error', $reminder['message']);
        }

        return redirect($reminder['wa_link'])
            ->with('success', 'Silakan kirim pesan pengingat kepada donatur melalui WhatsApp.');
    }
}
