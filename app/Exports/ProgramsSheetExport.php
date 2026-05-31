<?php

namespace App\Exports;

use App\Models\Program;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProgramsSheetExport implements FromCollection, WithHeadings, WithTitle, WithMapping, ShouldAutoSize, WithStyles
{
    public function collection()
    {
        return Program::withCount(['transactions' => function ($query) {
            $query->where('status', 'confirmed');
        }])
        ->withSum(['transactions' => function ($query) {
            $query->where('status', 'confirmed');
        }], 'jumlah')
        ->latest()
        ->get();
    }

    public function title(): string
    {
        return 'Data Program';
    }

    public function headings(): array
    {
        return [
            'Nama Program',
            'Jenis',
            'Target Dana (Rp)',
            'Terkumpul (Rp)',
            'Status',
            'Tgl Mulai',
            'Tgl Selesai',
            'Jumlah Donatur',
        ];
    }

    public function map($program): array
    {
        return [
            $program->nama,
            ucfirst($program->type),
            $program->target_dana ?? 0,
            $program->transactions_sum_jumlah ?? 0,
            $program->is_active ? 'Aktif' : 'Non-aktif',
            $program->start_date?->format('d/m/Y') ?? '-',
            $program->end_date?->format('d/m/Y') ?? '-',
            $program->transactions_count,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
