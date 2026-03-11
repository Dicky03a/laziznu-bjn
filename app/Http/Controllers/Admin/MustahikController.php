<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MustahikRequest;
use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\Mustahik;

class MustahikController extends Controller
{
    public function index()
    {
        $query = Mustahik::with(['kecamatan', 'desa']);

        // Search functionality
        if (request('search')) {
            $search = request('search');
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('nik', 'like', "%{$search}%")
                    ->orWhere('no_hp', 'like', "%{$search}%");
            });
        }

        // Filter Kecamatan
        if (request('kecamatan_id')) {
            $query->where('kecamatan_id', request('kecamatan_id'));
        }

        // Filter Desa
        if (request('desa_id')) {
            $query->where('desa_id', request('desa_id'));
        }

        // Filter Kategori
        if (request('kategori_asnaf')) {
            $query->where('kategori_asnaf', request('kategori_asnaf'));
        }

        // Filter Status
        if (request('status')) {
            $query->where('status', request('status'));
        }

        $mustahiks = $query->latest()->paginate(10);

        $kecamatans = Kecamatan::orderBy('nama')->get();

        $desas = collect();
        if (request('kecamatan_id')) {
            $desas = Desa::where('kecamatan_id', request('kecamatan_id'))
                ->orderBy('nama')
                ->get();
        }

        // statistics
        $totalMustahik = Mustahik::count();
        $totalAktif = Mustahik::where('status', 'aktif')->count();
        $totalNonaktif = Mustahik::where('status', 'nonaktif')->count();
        $totalDesa = Desa::count();

        // Statistik Kecamatan
        $statistikKecamatan = Kecamatan::withCount([
            'mustahiks',
            'mustahiks as mustahiks_aktif' => function ($query) {
                $query->where('status', 'aktif');
            },
        ])->get();

        // Statistik Desa 
        $statistikDesa = collect();
        if (request('kecamatan_id')) {
            $statistikDesa = Desa::where('kecamatan_id', request('kecamatan_id'))
                ->withCount([
                    'mustahiks',
                    'mustahiks as mustahiks_aktif' => function ($query) {
                        $query->where('status', 'aktif');
                    },
                ])->get();
        }

        // Statistik Kategori Asnaf
        $statistikKategori = Mustahik::select('kategori_asnaf')
            ->selectRaw('COUNT(*) as total')
            ->selectRaw("SUM(CASE WHEN status = 'aktif' THEN 1 ELSE 0 END) as aktif")
            ->groupBy('kategori_asnaf')
            ->get();

        return view('admin.mustahiks.index', compact(
            'mustahiks',
            'kecamatans',
            'desas',
            'totalMustahik',
            'totalAktif',
            'totalNonaktif',
            'totalDesa',
            'statistikKecamatan',
            'statistikDesa',
            'statistikKategori'
        ));
    }

    public function create()
    {
        $kecamatans = Kecamatan::orderBy('nama')->get();
        $desas = Desa::orderBy('nama')->get();

        return view('admin.mustahiks.create', compact('kecamatans', 'desas'));
    }

    public function store(MustahikRequest $request)
    {
        Mustahik::create($request->validated());

        return redirect()->route('mustahiks.index')
            ->with('success', 'Data mustahik berhasil ditambahkan');
    }

    public function show(Mustahik $mustahik)
    {
        $mustahik->load(['kecamatan', 'desa']);

        return view('admin.mustahiks.show', compact('mustahik'));
    }

    public function edit(Mustahik $mustahik)
    {
        $kecamatans = Kecamatan::orderBy('nama')->get();
        $desas = Desa::orderBy('nama')->get();

        return view('admin.mustahiks.edit', compact('mustahik', 'kecamatans', 'desas'));
    }

    public function update(MustahikRequest $request, Mustahik $mustahik)
    {
        $mustahik->update($request->validated());

        return redirect()->route('mustahiks.index')
            ->with('success', 'Data mustahik berhasil diperbarui');
    }

    public function destroy(Mustahik $mustahik)
    {
        $nama = $mustahik->nama;
        $mustahik->delete();

        return redirect()->route('mustahiks.index')
            ->with('success', "Data mustahik {$nama} berhasil dihapus");
    }

    public function getDesa($kecamatanId)
    {
        $desas = Desa::where('kecamatan_id', $kecamatanId)
            ->orderBy('nama')
            ->get(['id', 'nama']);

        return response()->json($desas);
    }

    public function filterByKategori($kategori)
    {
        $mustahiks = Mustahik::byKategori($kategori)
            ->with(['kecamatan', 'desa'])
            ->get();

        return response()->json($mustahiks);
    }
    
    public function statistik()
    {
        $total = Mustahik::count();
        $aktif = Mustahik::where('status', 'aktif')->count();
        $nonaktif = Mustahik::where('status', 'nonaktif')->count();
        $byKategori = Mustahik::selectRaw('kategori_asnaf, COUNT(*) as count')
            ->groupBy('kategori_asnaf')
            ->get();

        return response()->json([
            'total' => $total,
            'aktif' => $aktif,
            'nonaktif' => $nonaktif,
            'by_kategori' => $byKategori,
        ]);
    }
}
