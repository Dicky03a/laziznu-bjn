<?php

namespace App\Exports;

use App\Models\DistributionProgram;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DistributionProgramsSheetExport implements FromCollection, WithHeadings, WithTitle, WithMapping, ShouldAutoSize, WithStyles
{
    public function collection()
    {
        return DistributionProgram::with('sourceProgram')->latest()->get();
    }

    public function title(): string
    {
        return 'Penyaluran Program';
    }

    public function headings(): array
    {
        return [
            'Nama Penyaluran',
            'Program Sumber',
            'Alokasi Dana (Rp)',
            'Status',
            'Tgl Mulai',
            'Tgl Selesai',
        ];
    }

    public function map($dist): array
    {
        return [
            $dist->nama,
            $dist->sourceProgram?->nama ?? '-',
            $dist->target_dana,
            $dist->is_active ? 'Aktif' : 'Non-aktif',
            $dist->start_date?->format('d/m/Y') ?? '-',
            $dist->end_date?->format('d/m/Y') ?? '-',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
