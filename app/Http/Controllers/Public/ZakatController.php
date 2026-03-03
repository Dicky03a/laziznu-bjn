<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreZakatRequest;
use App\Models\Setting;
use App\Models\Transaction;
use App\Services\TransactionService;

class ZakatController extends Controller
{
    public function __construct(
        protected TransactionService $transactionService
    ) {}

    public function index()
    {
        $settings = [
            'zakat_fitrah_per_jiwa' => Setting::zakatFitrahPerJiwa(),
            'zakat_mal_persen' => Setting::zakatMalPersen(),
            'nisab_mal' => Setting::nisabMal(),
            'nisab_emas_gram' => Setting::nisabEmasGram(),
            'harga_emas_per_gram' => Setting::hargaEmasPerGram(),
        ];

        $totalMuzakki = Transaction::ofType('zakat')->confirmed()->count();
        $totalTerkumpul = Transaction::ofType('zakat')->confirmed()->sum('jumlah');

        return view('pages.public.zakat.index', compact('settings', 'totalMuzakki', 'totalTerkumpul'));
    }

    public function store(StoreZakatRequest $request)
    {
        $transaction = $this->transactionService->createZakat($request->validated());

        return redirect()
            ->route('payment.show', $transaction->kode_transaksi)
            ->with('success', 'Transaksi zakat berhasil dibuat. Silakan lanjutkan pembayaran.');
    }
}
