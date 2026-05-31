<?php

namespace App\Exports\PetaSebaran;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class FilteredMuzakisSheet implements FromCollection, WithHeadings, WithTitle, WithMapping, ShouldAutoSize, WithStyles
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        return Transaction::query()
            ->with(['kecamatan', 'desa'])
            ->where('status', 'confirmed')
            ->where('type', 'zakat')
            ->when($this->filters['kecamatan_id'] ?? null, fn ($q) => $q->where('kecamatan_id', $this->filters['kecamatan_id']))
            ->when($this->filters['desa_id'] ?? null, fn ($q) => $q->where('desa_id', $this->filters['desa_id']))
            ->when($this->filters['search'] ?? null, function ($q) {
                $search = $this->filters['search'];
                $q->where(function ($sub) use ($search) {
                    $sub->where('nama_donatur', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('telepon', 'like', "%{$search}%")
                        ->orWhere('kode_transaksi', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->get();
    }

    public function title(): string
    {
        return 'Data Muzaki';
    }

    public function headings(): array
    {
        return [
            'Kode Transaksi',
            'Nama Donatur',
            'Email',
            'Telepon',
            'Kecamatan',
            'Desa',
            'Jenis Zakat',
            'Jumlah (Rp)',
            'Tanggal Konfirmasi',
        ];
    }

    public function map($muzaki): array
    {
        $jenis = $muzaki->metadata['jenis'] ?? 'N/A';
        return [
            $muzaki->kode_transaksi,
            $muzaki->nama_donatur,
            $muzaki->email ?? '-',
            $muzaki->telepon ?? '-',
            $muzaki->kecamatan?->nama ?? '-',
            $muzaki->desa?->nama ?? '-',
            ucfirst($jenis),
            $muzaki->jumlah,
            $muzaki->confirmed_at?->format('d/m/Y H:i') ?? $muzaki->created_at->format('d/m/Y H:i'),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
