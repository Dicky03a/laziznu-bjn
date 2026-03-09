<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MustahikRequest;
use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\Mustahik;

class MustahikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Base query with relationships
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

        // Filter by Kecamatan
        if (request('kecamatan_id')) {
            $query->where('kecamatan_id', request('kecamatan_id'));
        }

        // Filter by Desa
        if (request('desa_id')) {
            $query->where('desa_id', request('desa_id'));
        }

        // Filter by Kategori
        if (request('kategori_asnaf')) {
            $query->where('kategori_asnaf', request('kategori_asnaf'));
        }

        // Filter by Status
        if (request('status')) {
            $query->where('status', request('status'));
        }

        // Paginate results
        $mustahiks = $query->latest()->paginate(10);

        // Get all kecamatans for filter dropdowns
        $kecamatans = Kecamatan::orderBy('nama')->get();

        // Get desas only for selected kecamatan (or empty if none selected)
        $desas = collect();
        if (request('kecamatan_id')) {
            $desas = Desa::where('kecamatan_id', request('kecamatan_id'))
                ->orderBy('nama')
                ->get();
        }

        // Calculate statistics
        $totalMustahik = Mustahik::count();
        $totalAktif = Mustahik::where('status', 'aktif')->count();
        $totalNonaktif = Mustahik::where('status', 'nonaktif')->count();
        $totalDesa = Desa::count();

        // Statistik per Kecamatan
        $statistikKecamatan = Kecamatan::withCount([
            'mustahiks',
            'mustahiks as mustahiks_aktif' => function ($query) {
                $query->where('status', 'aktif');
            },
        ])->get();

        // Statistik per Desa (jika ada filter kecamatan)
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

        // Statistik per Kategori Asnaf
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kecamatans = Kecamatan::orderBy('nama')->get();
        $desas = Desa::orderBy('nama')->get();

        return view('admin.mustahiks.create', compact('kecamatans', 'desas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MustahikRequest $request)
    {
        Mustahik::create($request->validated());

        return redirect()->route('mustahiks.index')
            ->with('success', 'Data mustahik berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mustahik $mustahik)
    {
        $mustahik->load(['kecamatan', 'desa']);

        return view('admin.mustahiks.show', compact('mustahik'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mustahik $mustahik)
    {
        $kecamatans = Kecamatan::orderBy('nama')->get();
        $desas = Desa::orderBy('nama')->get();

        return view('admin.mustahiks.edit', compact('mustahik', 'kecamatans', 'desas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MustahikRequest $request, Mustahik $mustahik)
    {
        $mustahik->update($request->validated());

        return redirect()->route('mustahiks.index')
            ->with('success', 'Data mustahik berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mustahik $mustahik)
    {
        $nama = $mustahik->nama;
        $mustahik->delete();

        return redirect()->route('mustahiks.index')
            ->with('success', "Data mustahik {$nama} berhasil dihapus");
    }

    /**
     * Get desa by kecamatan (AJAX API endpoint)
     */
    public function getDesa($kecamatanId)
    {
        $desas = Desa::where('kecamatan_id', $kecamatanId)
            ->orderBy('nama')
            ->get(['id', 'nama']);

        return response()->json($desas);
    }

    /**
     * Filter mustahik by kategori (API endpoint)
     */
    public function filterByKategori($kategori)
    {
        $mustahiks = Mustahik::byKategori($kategori)
            ->with(['kecamatan', 'desa'])
            ->get();

        return response()->json($mustahiks);
    }

    /**
     * Get statistik mustahik (API endpoint)
     */
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
