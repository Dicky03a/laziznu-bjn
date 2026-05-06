<?php

namespace App\Services;

use App\Models\PaymentConfirmation;
use App\Models\Program;
use App\Models\Setting;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class TransactionService
{
    /**
     * Manual transaction creation by admin with direct confirmation.
     */
    public function manualCreate(array $data, int $adminId): Transaction
    {
        return DB::transaction(function () use ($data, $adminId) {
            $metadata = $this->prepareMetadata($data);

            $transaction = Transaction::create([
                'kode_transaksi' => Transaction::generateKode($data['type']),
                'type' => $data['type'],
                'program_id' => $data['program_id'] ?? null,
                'nama_donatur' => $data['nama_donatur'],
                'email' => $data['email'] ?? null,
                'telepon' => $data['telepon'] ?? null,
                'kecamatan_id' => $data['kecamatan_id'] ?? null,
                'desa_id' => $data['desa_id'] ?? null,
                'is_anonim' => (bool) ($data['is_anonim'] ?? false),
                'jumlah' => (int) $data['jumlah'],
                'metadata' => $metadata,
                'catatan' => $data['catatan'] ?? null,
                'status' => Transaction::STATUS_CONFIRMED,
                'confirmed_at' => now(),
                'confirmed_by' => $adminId,
            ]);

            if (isset($data['bukti_transfer'])) {
                $path = $data['bukti_transfer']->store('payment-confirmations/'.now()->format('Y/m'), 'public');

                PaymentConfirmation::create([
                    'transaction_id' => $transaction->id,
                    'nama_pengirim' => $data['nama_donatur'],
                    'bank_pengirim' => 'Manual Admin',
                    'jumlah_transfer' => $data['jumlah'],
                    'tanggal_transfer' => now(),
                    'bukti_transfer' => $path,
                ]);
            }

            return $transaction;
        });
    }

    /**
     * Prepare metadata based on transaction type.
     */
    protected function prepareMetadata(array $data): array
    {
        $metadata = [];
        if ($data['type'] === 'zakat') {
            if (($data['zakat_jenis'] ?? '') === 'mal') {
                $metadata = [
                    'jenis' => 'mal',
                    'nilai_harta' => (int) ($data['nilai_harta'] ?? 0),
                ];
            } else {
                $metadata = [
                    'jenis' => 'fitrah',
                    'jumlah_jiwa' => (int) ($data['jumlah_jiwa'] ?? 1),
                ];
            }
        } elseif ($data['type'] === 'fidyah') {
            $metadata = [
                'jumlah_hari' => (int) ($data['jumlah_hari'] ?? 1),
            ];
        }

        return $metadata;
    }

    public function createZakat(array $data): Transaction
    {
        return DB::transaction(function () use ($data) {
            $metadata = [];
            $jumlah = 0;

            if ($data['jenis'] === 'mal') {
                $persen = Setting::zakatMalPersen() / 100;
                $jumlah = (int) ($data['nilai_harta'] * $persen);
                $metadata = [
                    'jenis' => 'mal',
                    'nilai_harta' => (int) $data['nilai_harta'],
                    'nisab_rp' => Setting::nisabMal(),
                    'persen' => Setting::zakatMalPersen(),
                ];
            } elseif ($data['jenis'] === 'fitrah') {
                $hargaPerJiwa = Setting::zakatFitrahPerJiwa();
                $jumlah = $hargaPerJiwa * (int) $data['jumlah_jiwa'];
                $metadata = [
                    'jenis' => 'fitrah',
                    'jumlah_jiwa' => (int) $data['jumlah_jiwa'],
                    'harga_per_jiwa' => $hargaPerJiwa,
                ];
            }

            return Transaction::create([
                'kode_transaksi' => Transaction::generateKode('zakat'),
                'type' => 'zakat',
                'nama_donatur' => $data['nama_donatur'],
                'email' => $data['email'] ?? null,
                'telepon' => $data['telepon'] ?? null,
                'kecamatan_id' => $data['kecamatan_id'] ?? null,
                'desa_id' => $data['desa_id'] ?? null,
                'is_anonim' => (bool) ($data['is_anonim'] ?? false),
                'jumlah' => $jumlah,
                'metadata' => $metadata,
                'catatan' => $data['catatan'] ?? null,
                'status' => Transaction::STATUS_PENDING,
            ]);
        });
    }

    public function createProgramZakat(array $data, Program $program): Transaction
    {
        return DB::transaction(function () use ($data, $program) {
            return Transaction::create([
                'kode_transaksi' => Transaction::generateKode('zakat'),
                'type' => 'zakat',
                'program_id' => $program->id,
                'nama_donatur' => $data['nama_donatur'],
                'email' => $data['email'] ?? null,
                'telepon' => $data['telepon'] ?? null,
                'kecamatan_id' => $data['kecamatan_id'] ?? null,
                'desa_id' => $data['desa_id'] ?? null,
                'is_anonim' => (bool) ($data['is_anonim'] ?? false),
                'jumlah' => (int) $data['jumlah'],
                'metadata' => ['program_nama' => $program->nama],
                'catatan' => $data['catatan'] ?? null,
                'status' => Transaction::STATUS_PENDING,
            ]);
        });
    }

    public function createInfaq(array $data, Program $program): Transaction
    {
        return DB::transaction(function () use ($data, $program) {
            return Transaction::create([
                'kode_transaksi' => Transaction::generateKode('infaq'),
                'type' => 'infaq',
                'program_id' => $program->id,
                'nama_donatur' => $data['nama_donatur'],
                'email' => $data['email'] ?? null,
                'telepon' => $data['telepon'] ?? null,
                'kecamatan_id' => $data['kecamatan_id'] ?? null,
                'desa_id' => $data['desa_id'] ?? null,
                'is_anonim' => (bool) ($data['is_anonim'] ?? false),
                'jumlah' => (int) $data['jumlah'],
                'metadata' => ['program_nama' => $program->nama],
                'catatan' => $data['catatan'] ?? null,
                'status' => Transaction::STATUS_PENDING,
            ]);
        });
    }

    public function createDonasi(array $data, Program $program): Transaction
    {
        return DB::transaction(function () use ($data, $program) {
            return Transaction::create([
                'kode_transaksi' => Transaction::generateKode('donasi'),
                'type' => 'donasi',
                'program_id' => $program->id,
                'nama_donatur' => $data['nama_donatur'],
                'email' => $data['email'] ?? null,
                'telepon' => $data['telepon'] ?? null,
                'kecamatan_id' => $data['kecamatan_id'] ?? null,
                'desa_id' => $data['desa_id'] ?? null,
                'is_anonim' => (bool) ($data['is_anonim'] ?? false),
                'jumlah' => (int) $data['jumlah'],
                'metadata' => ['program_nama' => $program->nama],
                'catatan' => $data['catatan'] ?? null,
                'status' => Transaction::STATUS_PENDING,
            ]);
        });
    }

    public function createFidyah(array $data): Transaction
    {
        return DB::transaction(function () use ($data) {
            $hargaPerHari = Setting::fidyahPricePerDay();
            $jumlahHari = (int) $data['jumlah_hari'];
            $jumlah = $hargaPerHari * $jumlahHari;

            return Transaction::create([
                'kode_transaksi' => Transaction::generateKode('fidyah'),
                'type' => 'fidyah',
                'nama_donatur' => $data['nama_donatur'],
                'email' => $data['email'] ?? null,
                'telepon' => $data['telepon'] ?? null,
                'kecamatan_id' => $data['kecamatan_id'] ?? null,
                'desa_id' => $data['desa_id'] ?? null,
                'is_anonim' => (bool) ($data['is_anonim'] ?? false),
                'jumlah' => $jumlah,
                'metadata' => [
                    'jumlah_hari' => $jumlahHari,
                    'harga_per_hari' => $hargaPerHari,
                ],
                'catatan' => $data['catatan'] ?? null,
                'status' => Transaction::STATUS_PENDING,
            ]);
        });
    }

    public function confirm(Transaction $transaction, int $adminId, ?string $catatan = null): Transaction
    {
        $transaction->update([
            'status' => Transaction::STATUS_CONFIRMED,
            'confirmed_at' => now(),
            'confirmed_by' => $adminId,
            'catatan_admin' => $catatan,
        ]);

        return $transaction->fresh();
    }

    public function reject(Transaction $transaction, int $adminId, ?string $catatan = null): Transaction
    {
        $transaction->update([
            'status' => Transaction::STATUS_REJECTED,
            'confirmed_by' => $adminId,
            'catatan_admin' => $catatan,
        ]);

        return $transaction->fresh();
    }

    /**
     * Get transaction statistics for admin dashboard.
     */
    public function getTransactionStats(): array
    {
        $stats = Transaction::selectRaw('
                count(case when status = "pending" then 1 end) as total_pending,
                count(case when status = "confirmed" then 1 end) as total_confirmed,
                count(case when date(created_at) = ? then 1 end) as total_today,
                sum(case when status = "confirmed" then jumlah else 0 end) as total_nominal
            ', [today()->toDateString()])
            ->first();

        return [
            'total_pending' => $stats->total_pending ?? 0,
            'total_confirmed' => $stats->total_confirmed ?? 0,
            'total_today' => $stats->total_today ?? 0,
            'total_nominal' => $stats->total_nominal ?? 0,
        ];
    }
}
