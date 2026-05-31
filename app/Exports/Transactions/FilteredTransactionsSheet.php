<?php

namespace App\Exports\Transactions;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class FilteredTransactionsSheet implements FromCollection, WithHeadings, WithTitle, WithMapping, ShouldAutoSize, WithStyles
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        return Transaction::query()
            ->with(['program', 'kecamatan', 'desa'])
            ->when($this->filters['types'] ?? null, function ($q) {
                $q->where(function ($sub) {
                    foreach ($this->filters['types'] as $type) {
                        if ($type === 'zakat') {
                            $sub->orWhere(fn ($q2) => $q2->where('type', 'zakat')->whereNull('program_id'));
                        } elseif ($type === 'zakat_program') {
                            $sub->orWhere(fn ($q2) => $q2->where('type', 'zakat')->whereNotNull('program_id'));
                        } else {
                            $sub->orWhere('type', $type);
                        }
                    }
                });
            })
            ->when($this->filters['status'] ?? null, fn ($q) => $q->where('status', $this->filters['status']))
            ->when($this->filters['tanggal_dari'] ?? null, fn ($q) => $q->whereDate('created_at', '>=', $this->filters['tanggal_dari']))
            ->when($this->filters['tanggal_sampai'] ?? null, fn ($q) => $q->whereDate('created_at', '<=', $this->filters['tanggal_sampai']))
            ->when($this->filters['search'] ?? null, fn ($q) => $q->where(function ($q2) {
                $q2->where('kode_transaksi', 'like', '%' . $this->filters['search'] . '%')
                    ->orWhere('nama_donatur', 'like', '%' . $this->filters['search'] . '%')
                    ->orWhere('email', 'like', '%' . $this->filters['search'] . '%');
            }))
            ->latest()
            ->get();
    }

    public function title(): string
    {
        return 'Detail Transaksi';
    }

    public function headings(): array
    {
        return [
            'Kode Transaksi',
            'Tanggal',
            'Jenis',
            'Program',
            'Nama Donatur',
            'Email',
            'Telepon',
            'Kecamatan',
            'Desa',
            'Jumlah (Rp)',
            'Status',
            'Catatan',
        ];
    }

    public function map($t): array
    {
        $typeLabel = $t->type === 'infaq' ? 'DSKL' : (
            $t->type === 'donasi' ? 'Infaq & Sodakoh' : (
                $t->type === 'zakat' && $t->program_id ? 'Zakat Program' : (
                    $t->type === 'zakat' ? 'Zakat' : $t->type_label
                )
            )
        );

        return [
            $t->kode_transaksi,
            $t->created_at->format('d/m/Y H:i'),
            $typeLabel . ($t->subtype ? " ({$t->subtype})" : ''),
            $t->program?->nama ?? '-',
            $t->nama_tampil,
            $t->email ?? '-',
            $t->telepon ?? '-',
            $t->kecamatan?->nama ?? '-',
            $t->desa?->nama ?? '-',
            $t->jumlah,
            $t->status_label,
            $t->catatan ?? '-',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
