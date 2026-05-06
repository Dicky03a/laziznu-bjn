<?php

namespace App\Services;

use App\Models\QurbanHewan;
use App\Models\QurbanPaymentConfirmation;
use App\Models\QurbanRegistration;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class QurbanService
{
    /**
     * Register a new qurban participant (usually from public frontend).
     */
    public function register(array $data, QurbanHewan $hewan): QurbanRegistration
    {
        return DB::transaction(function () use ($data, $hewan) {
            $hewan = QurbanHewan::lockForUpdate()->findOrFail($hewan->id);

            $this->validateSlotAvailability($hewan);

            if (! $hewan->period->is_open) {
                throw ValidationException::withMessages([
                    'period_id' => 'Pendaftaran qurban periode ini sudah ditutup.',
                ]);
            }

            return QurbanRegistration::create([
                'kode_registrasi' => QurbanRegistration::generateKode(),
                'hewan_id' => $hewan->id,
                'period_id' => $hewan->period_id,
                'nama_peserta' => $data['nama_peserta'],
                'atas_nama' => $data['atas_nama'] ?? null,
                'email' => $data['email'] ?? null,
                'telepon' => $data['telepon'] ?? null,
                'alamat' => $data['alamat'] ?? null,
                'catatan' => $data['catatan'] ?? null,
                'jumlah_slot' => 1,
                'harga_per_slot' => $hewan->harga_per_slot,
                'total_bayar' => $hewan->harga_per_slot,
                'status' => QurbanRegistration::STATUS_PENDING,
            ]);
        });
    }

    /**
     * Manual registration by admin with direct confirmation.
     */
    public function manualRegister(array $data, QurbanHewan $hewan, int $adminId): QurbanRegistration
    {
        return DB::transaction(function () use ($data, $hewan, $adminId) {
            $hewan = QurbanHewan::lockForUpdate()->findOrFail($hewan->id);

            $this->validateSlotAvailability($hewan);

            $registration = QurbanRegistration::create([
                'kode_registrasi' => QurbanRegistration::generateKode(),
                'hewan_id' => $hewan->id,
                'period_id' => $hewan->period_id,
                'nama_peserta' => $data['nama_peserta'],
                'atas_nama' => $data['atas_nama'] ?? null,
                'email' => $data['email'] ?? null,
                'telepon' => $data['telepon'] ?? null,
                'alamat' => $data['alamat'] ?? null,
                'catatan' => $data['catatan'] ?? null,
                'jumlah_slot' => 1,
                'harga_per_slot' => $hewan->harga_per_slot,
                'total_bayar' => $hewan->harga_per_slot,
                'status' => QurbanRegistration::STATUS_CONFIRMED,
                'confirmed_at' => now(),
                'confirmed_by' => $adminId,
            ]);

            if (isset($data['bukti_transfer'])) {
                $path = $data['bukti_transfer']->store('qurban-confirmations/'.now()->format('Y/m'), 'public');

                QurbanPaymentConfirmation::create([
                    'registration_id' => $registration->id,
                    'nama_pengirim' => $data['nama_peserta'],
                    'bank_pengirim' => 'Manual Admin',
                    'jumlah_transfer' => $hewan->harga_per_slot,
                    'tanggal_transfer' => now(),
                    'bukti_transfer' => $path,
                ]);
            }

            return $registration;
        });
    }

    /**
     * Validate if slots are available for the given animal.
     *
     * @throws ValidationException
     */
    protected function validateSlotAvailability(QurbanHewan $hewan): void
    {
        $summary = $this->getSlotSummary($hewan);

        if ($summary['slot_tersedia'] <= 0) {
            throw ValidationException::withMessages([
                'hewan_id' => 'Maaf, slot untuk hewan ini sudah penuh.',
            ]);
        }
    }

    public function storePaymentConfirmation(
        array $data,
        QurbanRegistration $registration
    ): QurbanPaymentConfirmation {
        $path = null;
        if (isset($data['bukti_transfer_file'])) {
            $path = $data['bukti_transfer_file']->store(
                'qurban-confirmations/'.now()->format('Y/m'),
                'public'
            );
        }

        return QurbanPaymentConfirmation::create([
            'registration_id' => $registration->id,
            'nama_pengirim' => $data['nama_pengirim'],
            'bank_pengirim' => $data['bank_pengirim'],
            'nomor_rekening_pengirim' => $data['nomor_rekening_pengirim'] ?? null,
            'jumlah_transfer' => $data['jumlah_transfer'],
            'tanggal_transfer' => $data['tanggal_transfer'],
            'bukti_transfer' => $path,
            'catatan' => $data['catatan'] ?? null,
        ]);
    }

    public function confirm(
        QurbanRegistration $registration,
        int $adminId,
        ?string $catatan = null
    ): QurbanRegistration {
        $registration->update([
            'status' => QurbanRegistration::STATUS_CONFIRMED,
            'confirmed_at' => now(),
            'confirmed_by' => $adminId,
            'catatan_admin' => $catatan,
        ]);

        return $registration->fresh();
    }

    public function cancel(
        QurbanRegistration $registration,
        int $adminId,
        string $catatan
    ): QurbanRegistration {
        $registration->update([
            'status' => QurbanRegistration::STATUS_CANCELLED,
            'confirmed_by' => $adminId,
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
        $pending = $byStatus['pending'] ?? 0;
        $cancelled = $byStatus['cancelled'] ?? 0;

        return [
            'max_peserta' => $hewan->max_peserta,
            'confirmed' => $confirmed,
            'pending' => $pending,
            'cancelled' => $cancelled,
            'slot_terisi' => $confirmed + $pending,   // "mengunci" slot
            'slot_tersedia' => max(0, $hewan->max_peserta - $confirmed - $pending),
            'is_penuh' => ($confirmed + $pending) >= $hewan->max_peserta,
        ];
    }

    /**
     * Get registration statistics for a period.
     */
    public function getRegistrationStats(int $periodId): array
    {
        $stats = QurbanRegistration::ofPeriod($periodId)
            ->selectRaw('
                count(case when status = "pending" then 1 end) as total_pending,
                count(case when status = "confirmed" then 1 end) as total_confirmed,
                sum(case when status = "confirmed" then total_bayar else 0 end) as total_nominal
            ')
            ->first();

        return [
            'total_pending' => $stats->total_pending ?? 0,
            'total_confirmed' => $stats->total_confirmed ?? 0,
            'total_nominal' => $stats->total_nominal ?? 0,
        ];
    }
}
