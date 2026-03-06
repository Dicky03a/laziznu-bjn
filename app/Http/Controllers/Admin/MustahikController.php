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
        $mustahiks = Mustahik::with(['kecamatan', 'desa'])
            ->latest()
            ->paginate(10);

        $kecamatans = Kecamatan::orderBy('nama')->get();

        return view('admin.mustahiks.index', compact('mustahiks', 'kecamatans'));
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
        $desas = \App\Models\Desa::where('kecamatan_id', $kecamatanId)
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
        $aktif = Mustahik::aktif()->count();
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
