<?php

namespace App\Exports\Qurban;

use App\Models\QurbanRegistration;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class FilteredQurbanRegistrationsSheet implements FromCollection, WithHeadings, WithTitle, WithMapping, ShouldAutoSize, WithStyles
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        return QurbanRegistration::query()
            ->with(['hewan', 'period'])
            ->when($this->filters['period_id'] ?? null, fn ($q) => $q->where('period_id', $this->filters['period_id']))
            ->when($this->filters['hewan_id'] ?? null, fn ($q) => $q->where('hewan_id', $this->filters['hewan_id']))
            ->when($this->filters['status'] ?? null, fn ($q) => $q->where('status', $this->filters['status']))
            ->when($this->filters['search'] ?? null, function ($q) {
                $search = $this->filters['search'];
                $q->where(function ($sub) use ($search) {
                    $sub->where('kode_registrasi', 'like', "%{$search}%")
                        ->orWhere('nama_peserta', 'like', "%{$search}%")
                        ->orWhere('atas_nama', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('telepon', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->get();
    }

    public function title(): string
    {
        return 'Detail Pendaftaran Qurban';
    }

    public function headings(): array
    {
        return [
            'Kode Registrasi',
            'Periode',
            'Nama Peserta',
            'Atas Nama',
            'Hewan',
            'Jumlah Slot',
            'Harga/Slot (Rp)',
            'Total Bayar (Rp)',
            'Status',
            'Tanggal Daftar',
            'Tanggal Konfirmasi',
            'Email',
            'Telepon',
            'Alamat',
            'Catatan',
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
            $reg->harga_per_slot,
            $reg->total_bayar,
            ucfirst($reg->status),
            $reg->created_at->format('d/m/Y H:i'),
            $reg->confirmed_at?->format('d/m/Y H:i') ?? '-',
            $reg->email ?? '-',
            $reg->telepon ?? '-',
            $reg->alamat ?? '-',
            $reg->catatan ?? '-',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
