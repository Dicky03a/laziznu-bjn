<?php

namespace App\Exports;

use App\Models\Mustahik;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MustahiksSheetExport implements FromCollection, WithHeadings, WithTitle, WithMapping, ShouldAutoSize, WithStyles
{
    public function collection()
    {
        return Mustahik::with(['kecamatan', 'desa'])->latest()->get();
    }

    public function title(): string
    {
        return 'Data Mustahik';
    }

    public function headings(): array
    {
        return [
            'Nama',
            'NIK',
            'Jenis Kelamin',
            'Kecamatan',
            'Desa',
            'No HP',
            'Kategori Asnaf',
            'Status',
        ];
    }

    public function map($m): array
    {
        return [
            $m->nama,
            $m->nik,
            ucfirst($m->jenis_kelamin),
            $m->kecamatan?->nama ?? '-',
            $m->desa?->nama ?? '-',
            $m->no_hp ?? '-',
            ucfirst($m->kategori_asnaf),
            ucfirst($m->status),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
