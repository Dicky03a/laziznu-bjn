<?php

namespace App\Exports\PetaSebaran;

use App\Models\Mustahik;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class FilteredMustahiksSheet implements FromCollection, WithHeadings, WithTitle, WithMapping, ShouldAutoSize, WithStyles
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        return Mustahik::query()
            ->with(['kecamatan', 'desa'])
            ->where('status', 'aktif')
            ->when($this->filters['kecamatan_id'] ?? null, fn ($q) => $q->where('kecamatan_id', $this->filters['kecamatan_id']))
            ->when($this->filters['desa_id'] ?? null, fn ($q) => $q->where('desa_id', $this->filters['desa_id']))
            ->when($this->filters['search'] ?? null, function ($q) {
                $search = $this->filters['search'];
                $q->where(function ($sub) use ($search) {
                    $sub->where('nama', 'like', "%{$search}%")
                        ->orWhere('nik', 'like', "%{$search}%")
                        ->orWhere('no_hp', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->get();
    }

    public function title(): string
    {
        return 'Data Mustahik';
    }

    public function headings(): array
    {
        return [
            'Nama Mustahik',
            'NIK',
            'Jenis Kelamin',
            'Kecamatan',
            'Desa',
            'No HP',
            'Kategori Asnaf',
            'Tanggal Terdaftar',
        ];
    }

    public function map($mustahik): array
    {
        return [
            $mustahik->nama,
            $mustahik->nik,
            ucfirst($mustahik->jenis_kelamin),
            $mustahik->kecamatan?->nama ?? '-',
            $mustahik->desa?->nama ?? '-',
            $mustahik->no_hp ?? '-',
            ucfirst($mustahik->kategori_asnaf),
            $mustahik->created_at->format('d/m/Y H:i'),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
