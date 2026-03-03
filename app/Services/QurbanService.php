<?php

namespace App\Services;

use App\Models\QurbanHewan;
use App\Models\QurbanPaymentConfirmation;
use App\Models\QurbanRegistration;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class QurbanService
{
      public function register(array $data, QurbanHewan $hewan): QurbanRegistration
      {
            return DB::transaction(function () use ($data, $hewan) {

                  $hewan = QurbanHewan::lockForUpdate()->findOrFail($hewan->id);

                  $slotTerisi = QurbanRegistration::where('hewan_id', $hewan->id)
                        ->whereIn('status', ['pending', 'confirmed'])
                        ->count();

                  $slotTersedia = $hewan->max_peserta - $slotTerisi;

                  if ($slotTersedia <= 0) {
                        throw ValidationException::withMessages([
                              'hewan_id' => 'Maaf, slot untuk hewan ini sudah penuh.',
                        ]);
                  }

                  if (! $hewan->period->is_open) {
                        throw ValidationException::withMessages([
                              'period_id' => 'Pendaftaran qurban periode ini sudah ditutup.',
                        ]);
                  }

                  return QurbanRegistration::create([
                        'kode_registrasi' => QurbanRegistration::generateKode(),
                        'hewan_id'        => $hewan->id,
                        'period_id'       => $hewan->period_id,
                        'nama_peserta'    => $data['nama_peserta'],
                        'atas_nama'       => $data['atas_nama'] ?? null,
                        'email'           => $data['email'] ?? null,
                        'telepon'         => $data['telepon'] ?? null,
                        'alamat'          => $data['alamat'] ?? null,
                        'catatan'         => $data['catatan'] ?? null,
                        'jumlah_slot'     => 1, 
                        'harga_per_slot'  => $hewan->harga_per_slot,
                        'total_bayar'     => $hewan->harga_per_slot,
                        'status'          => QurbanRegistration::STATUS_PENDING,
                  ]);
            });
      }

      public function storePaymentConfirmation(
            array $data,
            QurbanRegistration $registration
      ): QurbanPaymentConfirmation {
            $path = null;
            if (isset($data['bukti_transfer_file'])) {
                  $path = $data['bukti_transfer_file']->store(
                        'qurban-confirmations/' . now()->format('Y/m'),
                        'public'
                  );
            }

            return QurbanPaymentConfirmation::create([
                  'registration_id'         => $registration->id,
                  'nama_pengirim'           => $data['nama_pengirim'],
                  'bank_pengirim'           => $data['bank_pengirim'],
                  'nomor_rekening_pengirim' => $data['nomor_rekening_pengirim'] ?? null,
                  'jumlah_transfer'         => $data['jumlah_transfer'],
                  'tanggal_transfer'        => $data['tanggal_transfer'],
                  'bukti_transfer'          => $path,
                  'catatan'                 => $data['catatan'] ?? null,
            ]);
      }

      public function confirm(
            QurbanRegistration $registration,
            int $adminId,
            ?string $catatan = null
      ): QurbanRegistration {
            $registration->update([
                  'status'        => QurbanRegistration::STATUS_CONFIRMED,
                  'confirmed_at'  => now(),
                  'confirmed_by'  => $adminId,
                  'catatan_admin' => $catatan,
            ]);

            return $registration->fresh();
      }

      public function cancel(
            QurbanRegistration $registration,
            int $adminId,
            string $catatan
      ): QurbanRegistration {
            if ($registration->is_confirmed) {

            }

            $registration->update([
                  'status'        => QurbanRegistration::STATUS_CANCELLED,
                  'confirmed_by'  => $adminId,
                  'catatan_admin' => $catatan,
            ]);

            return $registration->fresh();
      }

      public function getSlotSummary(QurbanHewan $hewan): array
      {
            $byStatus = QurbanRegistration::where('hewan_id', $hewan->id)
                  ->selectRaw('status, count(*) as total')
                  ->groupBy('status')
                  ->pluck('total', 'status')
                  ->toArray();

            $confirmed = $byStatus['confirmed'] ?? 0;
            $pending   = $byStatus['pending']   ?? 0;
            $cancelled = $byStatus['cancelled'] ?? 0;

            return [
                  'max_peserta'  => $hewan->max_peserta,
                  'confirmed'    => $confirmed,
                  'pending'      => $pending,
                  'cancelled'    => $cancelled,
                  'slot_terisi'  => $confirmed + $pending,   // "mengunci" slot
                  'slot_tersedia' => max(0, $hewan->max_peserta - $confirmed - $pending),
                  'is_penuh'     => ($confirmed + $pending) >= $hewan->max_peserta,
            ];
      }
}
