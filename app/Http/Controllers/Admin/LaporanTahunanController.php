<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLaporanTahunan;
use App\Http\Requests\UpdateLaporanTahunan;
use App\Models\LaporanTahunan;

class LaporanTahunanController extends Controller
{
    public function index()
    {
        $laporanTahunans = LaporanTahunan::paginate(10);

        return view('admin.laporan-tahunan.index', compact('laporanTahunans'));
    }

    public function create()
    {
        return view('admin.laporan-tahunan.create');
    }

    public function store(StoreLaporanTahunan $request)
    {
        try {
            LaporanTahunan::create($request->validated());

            return redirect()
                ->route('laporan-tahunans.index')
                ->with('success', __('Laporan tahunan berhasil ditambahkan'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('Terjadi kesalahan'));
        }
    }

    public function show(LaporanTahunan $laporanTahunan)
    {
        return view('admin.laporan-tahunan.show', compact('laporanTahunan'));
    }

    public function edit(LaporanTahunan $laporanTahunan)
    {
        return view('admin.laporan-tahunan.edit', compact('laporanTahunan'));
    }

    public function update(UpdateLaporanTahunan $request, LaporanTahunan $laporanTahunan)
    {
        try {
            $laporanTahunan->update($request->validated());

            return redirect()
                ->route('laporan-tahunans.show', $laporanTahunan)
                ->with('success', __('Laporan tahunan berhasil diperbarui'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('Terjadi kesalahan'));
        }
    }

    public function destroy(LaporanTahunan $laporanTahunan)
    {
        try {
            $laporanTahunan->delete();

            return redirect()
                ->route('laporan-tahunans.index')
                ->with('success', __('Laporan tahunan berhasil dihapus'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('Terjadi kesalahan'));
        }
    }
}
