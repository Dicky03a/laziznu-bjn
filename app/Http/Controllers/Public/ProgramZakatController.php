<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProgramZakatRequest;
use App\Models\Kecamatan;
use App\Models\Program;
use App\Services\TransactionService;

class ProgramZakatController extends Controller
{
    public function __construct(
        protected TransactionService $transactionService
    ) {}

    public function index()
    {
        $programs = Program::active()
            ->ofType('zakat')
            ->withCount(['confirmedTransactions as total_donatur'])
            ->latest('is_featured')
            ->latest()
            ->paginate(9);

        return view('pages.public.program-zakat.index', compact('programs'));
    }

    public function show(string $slug)
    {
        $program = Program::active()
            ->ofType('zakat')
            ->where('slug', $slug)
            ->firstOrFail();

        $kecamatans = Kecamatan::orderBy('nama')->get();

        $riwayatDonasi = $program->confirmedTransactions()
            ->latest()
            ->take(10)
            ->get();

        $totalTerkumpul = $program->total_terkumpul;
        $totalDonatur = $program->total_donatur;

        return view('pages.public.program-zakat.show', compact(
            'program',
            'kecamatans',
            'riwayatDonasi',
            'totalTerkumpul',
            'totalDonatur'
        ));
    }

    public function store(StoreProgramZakatRequest $request, string $slug)
    {
        $program = Program::active()
            ->ofType('zakat')
            ->where('slug', $slug)
            ->firstOrFail();

        $transaction = $this->transactionService->createProgramZakat(
            $request->validated(),
            $program
        );

        return redirect()
            ->route('payment.show', $transaction->kode_transaksi)
            ->with('success', 'Transaksi zakat program berhasil dibuat! Silakan lanjutkan pembayaran.');
    }
}
