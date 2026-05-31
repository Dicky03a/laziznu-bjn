<?php

namespace App\Exports;

use App\Models\Transaction;
use App\Models\Program;
use App\Models\DistributionProgram;
use App\Models\Mustahik;
use App\Models\QurbanRegistration;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Collection;

class SummarySheetExport implements FromCollection, WithHeadings, WithTitle, ShouldAutoSize, WithStyles
{
    public function collection()
    {
        $data = new Collection();

        // 1. Transactions by Type
        $data->push(['RINGKASAN TRANSAKSI (KONFIRMASI)', '']);
        
        $types = ['zakat', 'infaq', 'donasi', 'fidyah'];
        foreach ($types as $type) {
            $sum = Transaction::where('type', $type)->where('status', 'confirmed')->sum('jumlah');
            $count = Transaction::where('type', $type)->where('status', 'confirmed')->count();
            $data->push([Transaction::TYPE_LABELS[$type] ?? ucfirst($type), 'Rp ' . number_format($sum, 0, ',', '.') . ' (' . $count . ' Transaksi)']);
        }
        
        $totalSum = Transaction::where('status', 'confirmed')->sum('jumlah');
        $totalCount = Transaction::where('status', 'confirmed')->count();
        $data->push(['TOTAL KESELURUHAN', 'Rp ' . number_format($totalSum, 0, ',', '.') . ' (' . $totalCount . ' Transaksi)']);
        
        $data->push(['', '']);

        // 2. Program Stats
        $data->push(['STATISTIK PROGRAM', '']);
        $data->push(['Total Program', Program::count()]);
        $data->push(['Program Aktif', Program::where('is_active', true)->count()]);
        $data->push(['Total Alokasi Penyaluran', 'Rp ' . number_format(DistributionProgram::sum('target_dana'), 0, ',', '.')]);
        $data->push(['Total Program Penyaluran', DistributionProgram::count()]);
        
        $data->push(['', '']);

        // 3. Mustahik Stats
        $data->push(['DATA MUSTAHIK', '']);
        $data->push(['Total Mustahik', Mustahik::count()]);
        
        $data->push(['', '']);

        // 4. Qurban Stats
        $data->push(['DATA QURBAN (PERIODE AKTIF)', '']);
        $qurbanSum = QurbanRegistration::where('status', 'confirmed')->sum('total_bayar');
        $qurbanCount = QurbanRegistration::where('status', 'confirmed')->count();
        $data->push(['Total Dana Qurban', 'Rp ' . number_format($qurbanSum, 0, ',', '.')]);
        $data->push(['Total Peserta Qurban', $qurbanCount]);

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
            'Nilai/Keterangan',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
            2 => ['font' => ['bold' => true, 'italic' => true]],
            8 => ['font' => ['bold' => true]],
            11 => ['font' => ['bold' => true, 'italic' => true]],
            16 => ['font' => ['bold' => true, 'italic' => true]],
            20 => ['font' => ['bold' => true, 'italic' => true]],
        ];
    }
}
