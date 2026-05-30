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
            } elseif (($data['zakat_jenis'] ?? '') === 'fitrah') {
                $metadata = [
                    'jenis' => 'fitrah',
                    'jumlah_jiwa' => (int) ($data['jumlah_jiwa'] ?? 1),
                ];
            } elseif (! empty($data['program_id'])) {
                $metadata = [
                    'jenis' => 'program',
                ];
            } else {
                // Fallback to fitrah if no jenis and no program (though validation should prevent this)
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
    public function getTransactionStats($filters = []): array
    {
        $query = Transaction::query();

        // Apply filters
        if (! empty($filters['types']) && is_array($filters['types'])) {
            $query->where(function ($q) use ($filters) {
                foreach ($filters['types'] as $type) {
                    if ($type === 'zakat') {
                        $q->orWhere(fn ($q2) => $q2->where('type', 'zakat')->whereNull('program_id'));
                    } elseif ($type === 'zakat_program') {
                        $q->orWhere(fn ($q2) => $q2->where('type', 'zakat')->whereNotNull('program_id'));
                    } else {
                        $q->orWhere('type', $type);
                    }
                }
            });
        } elseif (! empty($filters['type'])) {
            $query->ofType($filters['type']);
        }

        if (! empty($filters['status'])) {
            $query->withStatus($filters['status']);
        }

        if (! empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('kode_transaksi', 'like', '%'.$search.'%')
                    ->orWhere('nama_donatur', 'like', '%'.$search.'%')
                    ->orWhere('email', 'like', '%'.$search.'%');
            });
        }

        if (! empty($filters['tanggal_dari'])) {
            $query->whereDate('created_at', '>=', $filters['tanggal_dari']);
        }

        if (! empty($filters['tanggal_sampai'])) {
            $query->whereDate('created_at', '<=', $filters['tanggal_sampai']);
        }

        // Clone the filtered query for overall stats
        $baseQuery = clone $query;

        $stats = $baseQuery->selectRaw('
                count(case when status = "pending" then 1 end) as total_pending,
                count(case when status = "confirmed" then 1 end) as total_confirmed,
                count(case when date(created_at) = ? then 1 end) as total_today,
                sum(case when status = "confirmed" then jumlah else 0 end) as total_nominal,
                sum(jumlah) as total_all_nominal
            ', [today()->toDateString()])
            ->first();

        return [
            'total_pending' => $stats->total_pending ?? 0,
            'total_confirmed' => $stats->total_confirmed ?? 0,
            'total_today' => $stats->total_today ?? 0,
            'total_nominal' => $stats->total_nominal ?? 0,
            'total_all_nominal' => $stats->total_all_nominal ?? 0,
            'total_count' => $query->count(),
        ];
    }
}
