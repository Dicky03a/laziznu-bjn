<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLaporanBulanan;
use App\Http\Requests\UpdateLaporanBulanan;
use App\Models\LaporanBulanan;
use Illuminate\Support\Facades\Storage;

class LaporanBulananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $laporanBulanans = LaporanBulanan::latest()->paginate(10);

        return view('admin.laporan-bulanan.index', compact('laporanBulanans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.laporan-bulanan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLaporanBulanan $request)
    {
        try {
            $validated = $request->validated();

            // Handle file upload
            if ($request->hasFile('file_laporan')) {
                $file = $request->file('file_laporan');
                $fileName = time().'_'.$file->getClientOriginalName();
                $file->storeAs('laporan-bulanan', $fileName, 'public');
                $validated['file_laporan'] = $fileName;
            }

            LaporanBulanan::create($validated);

            return redirect()
                ->route('laporan-bulanan.index')
                ->with('success', 'Laporan bulanan berhasil ditambahkan!');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Gagal menambahkan laporan: '.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(LaporanBulanan $laporanBulanan)
    {
        return view('admin.laporan-bulanan.show', compact('laporanBulanan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LaporanBulanan $laporanBulanan)
    {
        return view('admin.laporan-bulanan.edit', compact('laporanBulanan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLaporanBulanan $request, LaporanBulanan $laporanBulanan)
    {
        try {
            $validated = $request->validated();

            // Handle file upload
            if ($request->hasFile('file_laporan')) {
                // Delete old file
                if ($laporanBulanan->file_laporan && Storage::disk('public')->exists('laporan-bulanan/'.$laporanBulanan->file_laporan)) {
                    Storage::disk('public')->delete('laporan-bulanan/'.$laporanBulanan->file_laporan);
                }

                // Upload new file
                $file = $request->file('file_laporan');
                $fileName = time().'_'.$file->getClientOriginalName();
                $file->storeAs('laporan-bulanan', $fileName, 'public');
                $validated['file_laporan'] = $fileName;
            }

            $laporanBulanan->update($validated);

            return redirect()
                ->route('laporan-bulanan.index')
                ->with('success', 'Laporan bulanan berhasil diperbarui!');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Gagal memperbarui laporan: '.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LaporanBulanan $laporanBulanan)
    {
        try {
            // Delete file
            if ($laporanBulanan->file_laporan && Storage::disk('public')->exists('laporan-bulanan/'.$laporanBulanan->file_laporan)) {
                Storage::disk('public')->delete('laporan-bulanan/'.$laporanBulanan->file_laporan);
            }

            $laporanBulanan->delete();

            return redirect()
                ->route('laporan-bulanan.index')
                ->with('success', 'Laporan bulanan berhasil dihapus!');
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Gagal menghapus laporan: '.$e->getMessage());
        }
    }
}
