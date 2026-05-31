<?php

namespace App\Exports\Transactions;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Collection;

class FilteredTransactionsSummarySheet implements FromCollection, WithHeadings, WithTitle, ShouldAutoSize, WithStyles
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = Transaction::query()
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
            }));

        $transactions = $query->get();

        $data = new Collection();
        $data->push(['RINGKASAN LAPORAN TRANSAKSI', '']);
        $data->push(['Filter Tanggal', ($this->filters['tanggal_dari'] ?? 'Awal') . ' s/d ' . ($this->filters['tanggal_sampai'] ?? 'Sekarang')]);
        $data->push(['Status', ucfirst($this->filters['status'] ?? 'Semua')]);
        $data->push(['', '']);

        // Totals by Category
        $totalDSKL = $transactions->where('type', 'infaq')->sum('jumlah');
        $totalInfaqSodakoh = $transactions->where('type', 'donasi')->sum('jumlah');
        $totalZakat = $transactions->where('type', 'zakat')->whereNull('program_id')->sum('jumlah');
        $totalZakatProgram = $transactions->where('type', 'zakat')->whereNotNull('program_id')->sum('jumlah');
        $totalFidyah = $transactions->where('type', 'fidyah')->sum('jumlah');
        $totalDana = $transactions->sum('jumlah');

        $data->push(['TOTAL DANA DSKL', 'Rp ' . number_format($totalDSKL, 0, ',', '.')]);
        $data->push(['TOTAL DANA INFAQ & SODAKOH', 'Rp ' . number_format($totalInfaqSodakoh, 0, ',', '.')]);
        $data->push(['TOTAL DANA ZAKAT', 'Rp ' . number_format($totalZakat, 0, ',', '.')]);
        $data->push(['TOTAL DANA ZAKAT PROGRAM', 'Rp ' . number_format($totalZakatProgram, 0, ',', '.')]);
        $data->push(['TOTAL DANA FIDYAH', 'Rp ' . number_format($totalFidyah, 0, ',', '.')]);
        $data->push(['TOTAL KESELURUHAN', 'Rp ' . number_format($totalDana, 0, ',', '.')]);

        $data->push(['', '']);
        $data->push(['Jumlah Transaksi Terfilter', $transactions->count()]);

        return $data;
    }

    public function title(): string
    {
        return 'Ringkasan Laporan';
    }

    public function headings(): array
    {
        return [
            'Kategori',
            'Nilai',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
            5 => ['font' => ['bold' => true]],
            10 => ['font' => ['bold' => true]],
        ];
    }
}
