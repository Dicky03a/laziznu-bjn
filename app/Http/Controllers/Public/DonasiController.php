<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDonasiRequest;
use App\Models\Program;
use App\Services\TransactionService;

class DonasiController extends Controller
{
    public function __construct(
        protected TransactionService $transactionService
    ) {}

    /**
     * Daftar semua program donasi
     */
    public function index()
    {
        $programs = Program::active()
            ->ofType('donasi')
            ->withCount(['confirmedTransactions as total_donatur'])
            ->latest('is_featured')
            ->latest()
            ->paginate(9);

        return view('pages.public.donasi.index', compact('programs'));
    }

    /**
     * Detail program donasi + form pembayaran
     */
    public function show(string $slug)
    {
        $program = Program::active()
            ->ofType('donasi')
            ->where('slug', $slug)
            ->firstOrFail();

        $riwayatDonasi = $program->confirmedTransactions()->latest()->take(10)->get();
        $totalTerkumpul = $program->total_terkumpul;
        $totalDonatur = $program->total_donatur;
        $progressPersen = $program->progress_persen;

        return view('pages.public.donasi.show', compact(
            'program',
            'riwayatDonasi',
            'totalTerkumpul',
            'totalDonatur',
            'progressPersen'
        ));
    }

    /**
     * Simpan transaksi donasi
     */
    public function store(StoreDonasiRequest $request, string $slug)
    {
        $program = Program::active()
            ->ofType('donasi')
            ->where('slug', $slug)
            ->firstOrFail();

        $transaction = $this->transactionService->createDonasi(
            $request->validated(),
            $program
        );

        return redirect()
            ->route('payment.show', $transaction->kode_transaksi)
            ->with('success', 'Donasi berhasil! Silakan lanjutkan pembayaran.');
    }
}
