<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function __construct(
        protected TransactionService $transactionService
    ) {}

    public function index(Request $request)
    {
        $transactions = Transaction::query()
            ->with(['program', 'paymentConfirmation'])
            ->when($request->type, fn ($q) => $q->ofType($request->type))
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

        // Summary stats
        $stats = [
            'total_pending' => Transaction::pending()->count(),
            'total_confirmed' => Transaction::confirmed()->count(),
            'total_today' => Transaction::whereDate('created_at', today())->count(),
            'total_nominal' => Transaction::confirmed()->sum('jumlah'),
        ];

        return view('admin.transactions.index', compact('transactions', 'stats'));
    }

    public function show(Transaction $transaction)
    {
        $transaction->load(['program', 'paymentConfirmation', 'confirmedBy']);

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

    /**
     * Export CSV
     */
    public function export(Request $request)
    {
        $transactions = Transaction::query()
            ->with('program')
            ->when($request->type, fn ($q) => $q->ofType($request->type))
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

            foreach ($transactions as $t) {
                fputcsv($file, [
                    $t->kode_transaksi,
                    $t->created_at->format('d/m/Y H:i'),
                    $t->type_label.($t->subtype ? " ({$t->subtype})" : ''),
                    $t->program?->nama ?? '-',
                    $t->nama_tampil,
                    $t->email ?? '-',
                    $t->telepon ?? '-',
                    $t->jumlah,
                    $t->status_label,
                    $t->confirmed_at?->format('d/m/Y H:i') ?? '-',
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
