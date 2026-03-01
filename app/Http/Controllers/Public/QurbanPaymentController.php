<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQurbanPaymentConfirmationRequest;
use App\Models\QurbanRegistration;
use App\Models\Rekening;
use App\Services\QurbanService;

class QurbanPaymentController extends Controller
{
      public function __construct(
            protected QurbanService $qurbanService
      ) {}

      /**
       * Halaman instruksi pembayaran + form konfirmasi transfer.
       */
      public function show(string $kode)
      {
            $registration = QurbanRegistration::where('kode_registrasi', $kode)
                  ->with(['hewan.period', 'period', 'paymentConfirmation'])
                  ->firstOrFail();

            $rekenings = Rekening::all();

            return view('pages.public.qurban.payment', compact('registration', 'rekenings'));
      }

      /**
       * Simpan konfirmasi transfer dari peserta.
       */
      public function confirm(StoreQurbanPaymentConfirmationRequest $request, string $kode)
      {
            $registration = QurbanRegistration::where('kode_registrasi', $kode)
                  ->where('status', QurbanRegistration::STATUS_PENDING)
                  ->firstOrFail();

            if ($registration->paymentConfirmation) {
                  return back()->with('error', 'Konfirmasi sudah pernah dikirim sebelumnya.');
            }

            $data = $request->validated();

            if ($request->hasFile('bukti_transfer')) {
                  $data['bukti_transfer_file'] = $request->file('bukti_transfer');
            }

            $this->qurbanService->storePaymentConfirmation($data, $registration);

            return redirect()
                  ->route('qurban.payment', $kode)
                  ->with('success', 'Konfirmasi transfer berhasil dikirim! Tim kami akan memverifikasi dalam 1×24 jam.');
      }
}
