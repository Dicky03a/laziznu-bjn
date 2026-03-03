<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePaymentConfirmationRequest;
use App\Models\PaymentConfirmation;
use App\Models\Rekening;       // Model rekening bank yang sudah ada
use App\Models\Transaction;

class PaymentController extends Controller
{
    public function show(string $kode)
    {
        $transaction = Transaction::where('kode_transaksi', $kode)
            ->with(['program', 'paymentConfirmation'])
            ->firstOrFail();

        $rekenings = Rekening::all();

        $qrisType = in_array($transaction->type, ['zakat', 'fidyah']) ? 'zakat' : 'infaq';

        return view('pages.public.payment.show', compact('transaction', 'rekenings', 'qrisType'));
    }

    public function confirm(StorePaymentConfirmationRequest $request, string $kode)
    {
        $transaction = Transaction::where('kode_transaksi', $kode)
            ->where('status', Transaction::STATUS_PENDING)
            ->firstOrFail();

        if ($transaction->paymentConfirmation) {
            return back()->with('error', 'Konfirmasi sudah pernah dikirim. Tim kami sedang memproses.');
        }

        $path = null;
        if ($request->hasFile('bukti_transfer')) {
            $path = $request->file('bukti_transfer')
                ->store('payment-confirmations/'.now()->format('Y/m'), 'public');
        }

        PaymentConfirmation::create([
            'transaction_id' => $transaction->id,
            'nama_pengirim' => $request->nama_pengirim,
            'bank_pengirim' => $request->bank_pengirim,
            'nomor_rekening_pengirim' => $request->nomor_rekening_pengirim,
            'jumlah_transfer' => $request->jumlah_transfer,
            'tanggal_transfer' => $request->tanggal_transfer,
            'bukti_transfer' => $path,
            'catatan' => $request->catatan,
        ]);

        return redirect()
            ->route('payment.show', $kode)
            ->with('success', 'Konfirmasi transfer diterima! Tim kami akan memverifikasi dalam 1×24 jam.');
    }

    public function status(string $kode)
    {
        $transaction = Transaction::where('kode_transaksi', $kode)->firstOrFail();

        return response()->json([
            'status' => $transaction->status,
            'status_label' => $transaction->status_label,
        ]);
    }
}
