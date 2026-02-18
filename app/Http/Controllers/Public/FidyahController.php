<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFidyahRequest;
use App\Models\Setting;
use App\Models\Transaction;
use App\Services\TransactionService;

class FidyahController extends Controller
{
    public function __construct(
        protected TransactionService $transactionService
    ) {}

    public function index()
    {
        $hargaPerHari = Setting::fidyahPricePerDay();

        $totalTerkumpul = Transaction::ofType('fidyah')->confirmed()->sum('jumlah');
        $totalMembayar = Transaction::ofType('fidyah')->confirmed()->count();

        return view('pages.public.fidyah.index', compact('hargaPerHari', 'totalTerkumpul', 'totalMembayar'));
    }

    public function store(StoreFidyahRequest $request)
    {
        $transaction = $this->transactionService->createFidyah($request->validated());

        return redirect()
            ->route('payment.show', $transaction->kode_transaksi)
            ->with('success', 'Fidyah berhasil dibuat. Silakan lanjutkan pembayaran.');
    }
}
