<?php

namespace App\Exports\Qurban;

use App\Models\QurbanRegistration;
use App\Models\QurbanPeriod;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Collection;

class FilteredQurbanSummarySheet implements FromCollection, WithHeadings, WithTitle, ShouldAutoSize, WithStyles
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = QurbanRegistration::query()
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
            });

        $regs = $query->get();

        $data = new Collection();
        $data->push(['RINGKASAN LAPORAN PENDAFTARAN QURBAN', '']);
        
        $periodName = 'Semua Periode';
        if (!empty($this->filters['period_id'])) {
            $period = QurbanPeriod::find($this->filters['period_id']);
            $periodName = $period ? $period->nama : 'N/A';
        }
        $data->push(['Periode', $periodName]);
        $data->push(['Status', ucfirst($this->filters['status'] ?? 'Semua')]);
        $data->push(['Tanggal Cetak', now()->format('d/m/Y H:i')]);
        $data->push(['', '']);

        // Stats by Status
        $data->push(['STATISTIK STATUS', '']);
        $totalConfirmed = $regs->where('status', 'confirmed')->count();
        $totalPending = $regs->where('status', 'pending')->count();
        $totalCancelled = $regs->where('status', 'cancelled')->count();
        $data->push(['Dikonfirmasi', $totalConfirmed]);
        $data->push(['Menunggu', $totalPending]);
        $data->push(['Dibatalkan', $totalCancelled]);
        $data->push(['Total Pendaftaran', $regs->count()]);
        
        $data->push(['', '']);

        // Financial Stats
        $data->push(['STATISTIK DANA', '']);
        $danaTerkumpul = $regs->where('status', 'confirmed')->sum('total_bayar');
        $danaPending = $regs->where('status', 'pending')->sum('total_bayar');
        $data->push(['Total Dana Terkumpul (Confirmed)', 'Rp ' . number_format($danaTerkumpul, 0, ',', '.')]);
        $data->push(['Total Dana Tertunda (Pending)', 'Rp ' . number_format($danaPending, 0, ',', '.')]);
        $data->push(['Grand Total Dana (Semua)', 'Rp ' . number_format($regs->sum('total_bayar'), 0, ',', '.')]);

        return $data;
    }

    public function title(): string
    {
        return 'Ringkasan Qurban';
    }

    public function headings(): array
    {
        return ['Kategori', 'Nilai'];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 12]],
            7 => ['font' => ['bold' => true]],
            13 => ['font' => ['bold' => true]],
        ];
    }
}
