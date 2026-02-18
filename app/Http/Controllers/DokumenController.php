<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDokumenRequest;
use App\Http\Requests\UpdateDokumenRequest;
use App\Models\Dokuemen;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dokumens = Dokuemen::latest()->get();

        return view('admin.dokumens.index', compact('dokumens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dokumens.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDokumenRequest $request)
    {
        $data = $request->validated();

        $file = $request->file('file');

        $data['file'] = $file->storeAs(
            'dokumens',
            Str::uuid().'.'.$file->getClientOriginalExtension(),
            'public'
        );

        $data['ukuran_file'] = $file->getSize();
        $data['jumlah_download'] = 0;

        Dokuemen::create($data);

        return redirect()
            ->route('dokumens.index')
            ->with('success', 'Dokumen berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Dokuemen $dokumen)
    {
        return view('admin.dokumens.show', compact('dokumen'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dokuemen $dokumen)
    {
        return view('admin.dokumens.edit', compact('dokumen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDokumenRequest $request, Dokuemen $dokumen)
    {
        $data = $request->validated();

        if ($request->hasFile('file')) {

            // Hapus file lama
            if ($dokumen->file && Storage::disk('public')->exists($dokumen->file)) {
                Storage::disk('public')->delete($dokumen->file);
            }

            $file = $request->file('file');

            $data['file'] = $file->storeAs(
                'dokumens',
                Str::uuid().'.'.$file->getClientOriginalExtension(),
                'public'
            );

            $data['ukuran_file'] = $file->getSize();
        }

        $dokumen->update($data);

        return redirect()
            ->route('dokumens.index')
            ->with('success', 'Dokumen berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dokuemen $dokumen)
    {
        if ($dokumen->file && Storage::disk('public')->exists($dokumen->file)) {
            Storage::disk('public')->delete($dokumen->file);
        }

        $dokumen->delete();

        return redirect()
            ->route('dokumens.index')
            ->with('success', 'Dokumen berhasil dihapus');
    }

    /**
     * Download document + increment counter
     */
    public function download(Dokuemen $dokumen)
    {
        $dokumen->increment('jumlah_download');

        return Storage::disk('public')->download(
            $dokumen->file,
            $dokumen->nama_dokumen.'.'.pathinfo($dokumen->file, PATHINFO_EXTENSION)
        );
    }
}
