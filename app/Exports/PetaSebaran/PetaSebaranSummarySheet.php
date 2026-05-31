<?php

namespace App\Exports\PetaSebaran;

use App\Models\Transaction;
use App\Models\Mustahik;
use App\Models\Kecamatan;
use App\Models\Desa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class PetaSebaranSummarySheet implements FromCollection, WithHeadings, WithTitle, ShouldAutoSize, WithStyles
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $data = new Collection();
        $data->push(['RINGKASAN SEBARAN MUZAKI & MUSTAHIK', '']);
        $data->push(['Tanggal Cetak', now()->format('d/m/Y H:i')]);
        
        $kecamatanName = 'Semua Kecamatan';
        if (!empty($this->filters['kecamatan_id'])) {
            $kec = Kecamatan::find($this->filters['kecamatan_id']);
            $kecamatanName = $kec ? $kec->nama : 'N/A';
        }
        $data->push(['Wilayah', $kecamatanName]);
        
        $data->push(['', '']);

        // 1. General Stats
        $totalMuzaki = Transaction::where('status', 'confirmed')->where('type', 'zakat')->count();
        $totalDonasi = Transaction::where('status', 'confirmed')->where('type', 'zakat')->sum('jumlah');
        $totalMustahik = Mustahik::where('status', 'aktif')->count();
        $totalDesa = Desa::count();

        $data->push(['STATISTIK KESELURUHAN', '']);
        $data->push(['Total Muzaki', number_format($totalMuzaki)]);
        $data->push(['Total Dana Zakat Terkumpul', 'Rp ' . number_format($totalDonasi, 0, ',', '.')]);
        $data->push(['Total Mustahik (Aktif)', number_format($totalMustahik)]);
        $data->push(['Total Desa/Kelurahan', number_format($totalDesa)]);
        
        $data->push(['', '']);

        // 2. Stats per Kecamatan
        $data->push(['STATISTIK PER KECAMATAN', '', '', '', '']);
        $data->push(['Kecamatan', 'Total Muzaki', 'Total Mustahik', 'Total Dana', 'Rata-rata Donasi']);
        
        $statsKec = DB::table('kecamatans')
            ->leftJoin('transactions as t', function ($join) {
                $join->on('t.kecamatan_id', '=', 'kecamatans.id')
                    ->where('t.status', '=', 'confirmed')
                    ->where('t.type', '=', 'zakat');
            })
            ->leftJoin('mustahiks as m', function ($join) {
                $join->on('m.kecamatan_id', '=', 'kecamatans.id')
                    ->where('m.status', '=', 'aktif');
            })
            ->selectRaw('kecamatans.nama')
            ->selectRaw('COUNT(DISTINCT t.id) as total_muzaki')
            ->selectRaw('COUNT(DISTINCT m.id) as total_mustahik')
            ->selectRaw('COALESCE(SUM(t.jumlah), 0) as total_donasi')
            ->groupBy('kecamatans.id', 'kecamatans.nama')
            ->orderBy('kecamatans.nama')
            ->get();

        foreach ($statsKec as $s) {
            $avg = $s->total_muzaki > 0 ? $s->total_donasi / $s->total_muzaki : 0;
            $data->push([
                $s->nama,
                $s->total_muzaki,
                $s->total_mustahik,
                'Rp ' . number_format($s->total_donasi, 0, ',', '.'),
                'Rp ' . number_format($avg, 0, ',', '.')
            ]);
        }

        return $data;
    }

    public function title(): string
    {
        return 'Ringkasan Sebaran';
    }

    public function headings(): array
    {
        return [];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 14]],
            6 => ['font' => ['bold' => true]],
            12 => ['font' => ['bold' => true]],
            13 => ['font' => ['bold' => true]],
        ];
    }
}
