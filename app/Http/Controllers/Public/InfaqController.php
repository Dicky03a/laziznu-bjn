<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInfaqRequest;
use App\Models\Program;
use App\Services\TransactionService;

class InfaqController extends Controller
{
    public function __construct(
        protected TransactionService $transactionService
    ) {}

    public function index()
    {
        $programs = Program::active()
            ->ofType('infaq')
            ->withCount(['confirmedTransactions as total_donatur'])
            ->latest('is_featured')
            ->latest()
            ->paginate(9);

        return view('pages.public.infaq.index', compact('programs'));
    }

    public function show(string $slug)
    {
        $program = Program::active()
            ->ofType('infaq')
            ->where('slug', $slug)
            ->firstOrFail();

        // Transaksi terkonfirmasi untuk ditampilkan publik
        $riwayatDonasi = $program->confirmedTransactions()
            ->latest()
            ->take(10)
            ->get();

        $totalTerkumpul = $program->total_terkumpul;
        $totalDonatur = $program->total_donatur;

        return view('pages.public.infaq.show', compact(
            'program',
            'riwayatDonasi',
            'totalTerkumpul',
            'totalDonatur'
        ));
    }

    public function store(StoreInfaqRequest $request, string $slug)
    {
        $program = Program::active()
            ->ofType('infaq')
            ->where('slug', $slug)
            ->firstOrFail();

        $transaction = $this->transactionService->createInfaq(
            $request->validated(),
            $program
        );

        return redirect()
            ->route('payment.show', $transaction->kode_transaksi)
            ->with('success', 'Infaq berhasil! Silakan lanjutkan pembayaran.');
    }
}
