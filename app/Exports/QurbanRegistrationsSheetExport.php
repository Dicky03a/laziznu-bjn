<?php

namespace App\Exports;

use App\Models\QurbanRegistration;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class QurbanRegistrationsSheetExport implements FromCollection, WithHeadings, WithTitle, WithMapping, ShouldAutoSize, WithStyles
{
    public function collection()
    {
        return QurbanRegistration::with(['hewan', 'period'])
            ->where('status', 'confirmed')
            ->latest()
            ->get();
    }

    public function title(): string
    {
        return 'Data Qurban';
    }

    public function headings(): array
    {
        return [
            'Kode Registrasi',
            'Periode',
            'Peserta',
            'Atas Nama',
            'Hewan',
            'Slot',
            'Total Bayar (Rp)',
            'Tanggal Konfirmasi',
        ];
    }

    public function map($reg): array
    {
        return [
            $reg->kode_registrasi,
            $reg->period?->nama ?? '-',
            $reg->nama_peserta,
            $reg->atas_nama,
            $reg->hewan?->nama ?? '-',
            $reg->jumlah_slot,
            $reg->total_bayar,
            $reg->confirmed_at?->format('d/m/Y H:i') ?? '-',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
