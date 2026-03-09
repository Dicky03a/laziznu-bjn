<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\Mustahik;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PetaSebaranController extends Controller
{
    public function index(Request $request)
    {
        // Get all kecamatans & desas for filter dropdown (optimized)
        $kecamatans = Kecamatan::orderBy('nama')->get();
        $desas = Desa::when($request->kecamatan_id, function ($query) use ($request) {
            return $query->where('kecamatan_id', $request->kecamatan_id);
        })->orderBy('nama')->get();

        // Build base query untuk mustahik yang aktif
        $mustahikQuery = Mustahik::with(['kecamatan', 'desa'])
            ->where('status', 'aktif')
            ->orderBy('nama');

        // Build base query untuk muzaki yang dikonfirmasi
        $query = Transaction::with(['kecamatan', 'desa'])
            ->where('status', 'confirmed')
            ->where('type', 'zakat')
            ->orderBy('created_at', 'desc');

        // Apply filters to both queries
        if ($request->filled('kecamatan_id')) {
            $query->where('kecamatan_id', $request->kecamatan_id);
            $mustahikQuery->where('kecamatan_id', $request->kecamatan_id);
        }

        if ($request->filled('desa_id')) {
            $query->where('desa_id', $request->desa_id);
            $mustahikQuery->where('desa_id', $request->desa_id);
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('jenis')) {
            $query->whereJsonContains('metadata->jenis', $request->jenis);
        }

        // Apply search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_donatur', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('telepon', 'like', "%{$search}%")
                    ->orWhere('kode_transaksi', 'like', "%{$search}%");
            });

            $mustahikQuery->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('nik', 'like', "%{$search}%")
                    ->orWhere('no_hp', 'like', "%{$search}%");
            });
        }

        // Get paginated results
        $muzakis = $query->paginate(15)->appends($request->query());
        $mustahiks = $mustahikQuery->paginate(15, ['*'], 'mustahik_page')->appends($request->query());

        // Overall statistics - Optimized with batch queries
        $totalMuzaki = Transaction::where('status', 'confirmed')->where('type', 'zakat')->count();
        $totalDonasi = Transaction::where('status', 'confirmed')->where('type', 'zakat')->sum('jumlah');
        $totalMustahik = Mustahik::where('status', 'aktif')->count();
        $totalKecamatan = Kecamatan::count();
        $totalDesa = Desa::count();

        // Optimized: Use raw SQL untuk statistik kompleks
        $statistikKecamatan = $this->getOptimizedStatistikKecamatan();
        $statistikDesa = $this->getOptimizedStatistikDesa($request->kecamatan_id);

        return view('admin.peta-sebaran.index', compact(
            'muzakis',
            'kecamatans',
            'desas',
            'statistikKecamatan',
            'statistikDesa',
            'totalMuzaki',
            'totalDonasi',
            'totalKecamatan',
            'totalDesa',
            'mustahiks',
            'totalMustahik'
        ));
    }

    /**
     * Optimized: Get statistik kecamatan menggunakan raw SQL (1 query)
     */
    private function getOptimizedStatistikKecamatan()
    {
        return DB::table('kecamatans')
            ->leftJoin('transactions as t', function ($join) {
                $join->on('t.kecamatan_id', '=', 'kecamatans.id')
                    ->where('t.status', '=', 'confirmed')
                    ->where('t.type', '=', 'zakat');
            })
            ->leftJoin('mustahiks as m', function ($join) {
                $join->on('m.kecamatan_id', '=', 'kecamatans.id')
                    ->where('m.status', '=', 'aktif');
            })
            ->selectRaw('kecamatans.id')
            ->selectRaw('kecamatans.nama')
            ->selectRaw('COUNT(DISTINCT t.id) as total_muzaki')
            ->selectRaw('COUNT(DISTINCT m.id) as total_mustahik')
            ->selectRaw('COALESCE(SUM(t.jumlah), 0) as total_donasi')
            ->groupBy('kecamatans.id', 'kecamatans.nama')
            ->orderByDesc('total_muzaki')
            ->get();
    }

    /**
     * Optimized: Get statistik desa menggunakan raw SQL (1 query)
     */
    private function getOptimizedStatistikDesa($kecamatanId = null)
    {
        $query = DB::table('desas')
            ->leftJoin('transactions as t', function ($join) {
                $join->on('t.desa_id', '=', 'desas.id')
                    ->where('t.status', '=', 'confirmed')
                    ->where('t.type', '=', 'zakat');
            })
            ->leftJoin('mustahiks as m', function ($join) {
                $join->on('m.desa_id', '=', 'desas.id')
                    ->where('m.status', '=', 'aktif');
            })
            ->selectRaw('desas.id')
            ->selectRaw('desas.nama')
            ->selectRaw('desas.kecamatan_id')
            ->selectRaw('COUNT(DISTINCT t.id) as total_muzaki')
            ->selectRaw('COUNT(DISTINCT m.id) as total_mustahik')
            ->selectRaw('COALESCE(SUM(t.jumlah), 0) as total_donasi')
            ->groupBy('desas.id', 'desas.nama', 'desas.kecamatan_id');

        if ($kecamatanId) {
            $query->where('desas.kecamatan_id', $kecamatanId);
        }

        return $query->orderByDesc('total_muzaki')->get();
    }

    private function getStatistikDesaMustahik($kecamatanId = null)
    {
        $query = Desa::select('desas.id', 'desas.nama', 'desas.kecamatan_id')
            ->leftJoin('mustahiks', function ($join) {
                $join->on('mustahiks.desa_id', '=', 'desas.id')
                    ->where('mustahiks.status', 'aktif');
            })
            ->groupBy('desas.id', 'desas.nama', 'desas.kecamatan_id')
            ->selectRaw('COUNT(mustahiks.id) as total_mustahik');

        if ($kecamatanId) {
            $query->where('desas.kecamatan_id', $kecamatanId);
        }

        return $query->orderByDesc('total_mustahik')->get();
    }

    private function getStatistikKecamatanMustahik()
    {
        return Kecamatan::select('kecamatans.id', 'kecamatans.nama')
            ->leftJoin('mustahiks', function ($join) {
                $join->on('mustahiks.kecamatan_id', '=', 'kecamatans.id')
                    ->where('mustahiks.status', 'aktif');
            })
            ->groupBy('kecamatans.id', 'kecamatans.nama')
            ->selectRaw('COUNT(mustahiks.id) as total_mustahik')
            ->orderByDesc('total_mustahik')
            ->get();
    }

    private function getStatistikKecamatan()
    {
        return Kecamatan::select('kecamatans.id', 'kecamatans.nama')
            ->leftJoin('transactions', function ($join) {
                $join->on('transactions.kecamatan_id', '=', 'kecamatans.id')
                    ->where('transactions.status', Transaction::STATUS_CONFIRMED);
            })
            ->leftJoin('mustahiks', function ($join) {
                $join->on('mustahiks.kecamatan_id', '=', 'kecamatans.id')
                    ->where('mustahiks.status', 'aktif');
            })
            ->groupBy('kecamatans.id', 'kecamatans.nama')
            ->selectRaw('COUNT(DISTINCT transactions.id) as total_muzaki')
            ->selectRaw('COUNT(DISTINCT mustahiks.id) as total_mustahik')
            ->selectRaw('COALESCE(SUM(transactions.jumlah),0) as total_donasi')
            ->orderByDesc('total_muzaki')
            ->get();
    }

    private function getStatistikDesa($kecamatanId = null)
    {
        $query = Desa::select('desas.id', 'desas.nama', 'desas.kecamatan_id')
            ->leftJoin('transactions', function ($join) {
                $join->on('transactions.desa_id', '=', 'desas.id')
                    ->where('transactions.status', Transaction::STATUS_CONFIRMED);
            })
            ->leftJoin('mustahiks', function ($join) {
                $join->on('mustahiks.desa_id', '=', 'desas.id')
                    ->where('mustahiks.status', 'aktif');
            })
            ->groupBy('desas.id', 'desas.nama', 'desas.kecamatan_id')
            ->selectRaw('COUNT(DISTINCT transactions.id) as total_muzaki')
            ->selectRaw('COUNT(DISTINCT mustahiks.id) as total_mustahik')
            ->selectRaw('COALESCE(SUM(transactions.jumlah),0) as total_donasi');

        if ($kecamatanId) {
            $query->where('desas.kecamatan_id', $kecamatanId);
        }

        return $query->orderByDesc('total_muzaki')->get();
    }

    public function exportExcel(Request $request)
    {
        // Build query sesuai filter
        $query = Transaction::with(['kecamatan', 'desa'])
            ->where('status', Transaction::STATUS_CONFIRMED)
            ->orderBy('created_at', 'desc');

        if ($request->filled('kecamatan_id')) {
            $query->where('kecamatan_id', $request->kecamatan_id);
        }

        if ($request->filled('desa_id')) {
            $query->where('desa_id', $request->desa_id);
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_donatur', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('telepon', 'like', "%{$search}%")
                    ->orWhere('kode_transaksi', 'like', "%{$search}%");
            });
        }

        $muzakis = $query->get();

        // Create Excel manually menggunakan array
        $data = [];
        $data[] = ['Peta Sebaran Muzaki - Export Data'];
        $data[] = [];
        $data[] = [
            'No',
            'Kode Transaksi',
            'Nama Donatur',
            'Email',
            'Telepon',
            'Kecamatan',
            'Desa',
            'Jenis Zakat',
            'Jumlah',
            'Tipe',
            'Tanggal',
        ];

        foreach ($muzakis as $index => $muzaki) {
            $jenis = $muzaki->metadata['jenis'] ?? 'N/A';
            $data[] = [
                $index + 1,
                $muzaki->kode_transaksi,
                $muzaki->nama_donatur,
                $muzaki->email ?? '-',
                $muzaki->telepon ?? '-',
                $muzaki->kecamatan->nama ?? '-',
                $muzaki->desa->nama ?? '-',
                ucfirst($jenis),
                'Rp '.number_format($muzaki->jumlah, 0, ',', '.'),
                ucfirst($muzaki->type),
                $muzaki->created_at->format('d-m-Y H:i'),
            ];
        }

        // Generate Excel using PHP
        return $this->generateExcel($data);
    }

    private function generateExcel($data)
    {
        // Menggunakan method manual Excel
        // Jika menggunakan Laravel Excel, uncomment code di bawah:

        /*
        use Maatwebsite\Excel\Facades\Excel;
        return Excel::download(new PetaSebaranExport($data), 'peta-sebaran-muzaki-' . date('Y-m-d-His') . '.xlsx');
        */

        // Fallback: CSV export (lebih simple)
        $filename = 'peta-sebaran-muzaki-'.date('Y-m-d-His').'.csv';

        $callback = function () use ($data) {
            $file = fopen('php://output', 'w');

            // Set header untuk UTF-8 BOM (agar Excel recognize charset)
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            foreach ($data as $row) {
                fputcsv($file, $row, ';');
            }

            fclose($file);
        };

        return response()->streamDownload($callback, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="'.$filename.'"',
        ]);
    }

    public function getDesa(Request $request)
    {
        if (! $request->filled('kecamatan_id')) {
            return response()->json([]);
        }

        $desas = Desa::where('kecamatan_id', $request->kecamatan_id)
            ->orderBy('nama')
            ->get(['id', 'nama']);

        return response()->json($desas);
    }
}
