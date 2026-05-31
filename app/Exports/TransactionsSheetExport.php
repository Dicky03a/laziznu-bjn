<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TransactionsSheetExport implements FromCollection, WithHeadings, WithTitle, WithMapping, ShouldAutoSize, WithStyles
{
    public function collection()
    {
        return Transaction::with(['program', 'kecamatan', 'desa'])
            ->where('status', Transaction::STATUS_CONFIRMED)
            ->latest()
            ->get();
    }

    public function title(): string
    {
        return 'Data Transaksi';
    }

    public function headings(): array
    {
        return [
            'Kode Transaksi',
            'Tanggal Konfirmasi',
            'Jenis',
            'Program',
            'Nama Donatur',
            'Email',
            'Telepon',
            'Kecamatan',
            'Desa',
            'Jumlah (Rp)',
            'Catatan',
        ];
    }

    public function map($transaction): array
    {
        return [
            $transaction->kode_transaksi,
            $transaction->confirmed_at?->format('d/m/Y H:i') ?? '-',
            $transaction->type_label,
            $transaction->program?->nama ?? '-',
            $transaction->nama_tampil,
            $transaction->email ?? '-',
            $transaction->telepon ?? '-',
            $transaction->kecamatan?->nama ?? '-',
            $transaction->desa?->nama ?? '-',
            $transaction->jumlah,
            $transaction->catatan ?? '-',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
