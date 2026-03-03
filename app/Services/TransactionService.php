<?php

namespace App\Services;

use App\Models\Program;
use App\Models\Setting;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class TransactionService
{
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
                'alamat' => $data['alamat'] ?? null,
                'is_anonim' => (bool) ($data['is_anonim'] ?? false),
                'jumlah' => $jumlah,
                'metadata' => $metadata,
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
                'alamat' => $data['alamat'] ?? null,
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
                'alamat' => $data['alamat'] ?? null,
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
                'alamat' => $data['alamat'] ?? null,
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
}
