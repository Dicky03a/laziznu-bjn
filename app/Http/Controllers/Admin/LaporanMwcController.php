<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLaporanMwc;
use App\Http\Requests\UpdateLaporanMwc;
use App\Models\LaporanMwc;
use Illuminate\Support\Facades\Storage;

class LaporanMwcController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $laporanMwc = LaporanMwc::latest()->paginate(10);

        return view('admin.laporan-mwc.index', compact('laporanMwc'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.laporan-mwc.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLaporanMwc $request)
    {
        try {
            $validated = $request->validated();

            // Handle file upload
            if ($request->hasFile('file_laporan')) {
                $file = $request->file('file_laporan');
                $fileName = time().'_'.$file->getClientOriginalName();
                $file->storeAs('laporan-mwc', $fileName, 'public');
                $validated['file_laporan'] = $fileName;
            }

            LaporanMwc::create($validated);

            return redirect()
                ->route('laporan-mwc.index')
                ->with('success', 'Laporan MWC berhasil ditambahkan!');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Gagal menambahkan laporan: '.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(LaporanMwc $laporanMwc)
    {
        return view('admin.laporan-mwc.show', compact('laporanMwc'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LaporanMwc $laporanMwc)
    {
        return view('admin.laporan-mwc.edit', compact('laporanMwc'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLaporanMwc $request, LaporanMwc $laporanMwc)
    {
        try {
            $validated = $request->validated();

            // Handle file upload
            if ($request->hasFile('file_laporan')) {
                // Delete old file
                if ($laporanMwc->file_laporan && Storage::disk('public')->exists('laporan-mwc/'.$laporanMwc->file_laporan)) {
                    Storage::disk('public')->delete('laporan-mwc/'.$laporanMwc->file_laporan);
                }

                // Upload new file
                $file = $request->file('file_laporan');
                $fileName = time().'_'.$file->getClientOriginalName();
                $file->storeAs('laporan-mwc', $fileName, 'public');
                $validated['file_laporan'] = $fileName;
            }

            $laporanMwc->update($validated);

            return redirect()
                ->route('laporan-mwc.index')
                ->with('success', 'Laporan MWC berhasil diperbarui!');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Gagal memperbarui laporan: '.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LaporanMwc $laporanMwc)
    {
        try {
            // Delete file
            if ($laporanMwc->file_laporan && Storage::disk('public')->exists('laporan-mwc/'.$laporanMwc->file_laporan)) {
                Storage::disk('public')->delete('laporan-mwc/'.$laporanMwc->file_laporan);
            }

            $laporanMwc->delete();

            return redirect()
                ->route('laporan-mwc.index')
                ->with('success', 'Laporan MWC berhasil dihapus!');
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Gagal menghapus laporan: '.$e->getMessage());
        }
    }
}
