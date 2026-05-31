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
        $kecamatans = Kecamatan::orderBy('nama')->get();
        $desas = Desa::when($request->kecamatan_id, function ($query) use ($request) {
            return $query->where('kecamatan_id', $request->kecamatan_id);
        })->orderBy('nama')->get();

        $mustahikQuery = Mustahik::with(['kecamatan', 'desa'])
            ->where('status', 'aktif')
            ->orderBy('nama');

        $query = Transaction::with(['kecamatan', 'desa'])
            ->where('status', 'confirmed')
            ->where('type', 'zakat')
            ->orderBy('created_at', 'desc');

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

        // search
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

        $muzakis = $query->paginate(15)->appends($request->query());
        $mustahiks = $mustahikQuery->paginate(15, ['*'], 'mustahik_page')->appends($request->query());

        $totalMuzaki = Transaction::where('status', 'confirmed')->where('type', 'zakat')->count();
        $totalDonasi = Transaction::where('status', 'confirmed')->where('type', 'zakat')->sum('jumlah');
        $totalMustahik = Mustahik::where('status', 'aktif')->count();
        $totalKecamatan = Kecamatan::count();
        $totalDesa = Desa::count();

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

    public function exportExcel(Request $request)
    {
        $filters = $request->only(['kecamatan_id', 'desa_id', 'search']);
        $filename = 'laporan-sebaran-laziznu-'.now()->format('Y-m-d_His').'.xlsx';

        return \Maatwebsite\Excel\Facades\Excel::download(
            new \App\Exports\PetaSebaran\PetaSebaranExport($filters),
            $filename
        );
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
