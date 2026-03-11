<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDokumenRequest;
use App\Http\Requests\UpdateDokumenRequest;
use App\Models\Dokuemen;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DokumenController extends Controller
{
    public function index()
    {
        $dokumens = Dokuemen::latest()->get();

        return view('admin.dokumens.index', compact('dokumens'));
    }

    public function create()
    {
        return view('admin.dokumens.create');
    }

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

    public function show(Dokuemen $dokumen)
    {
        return view('admin.dokumens.show', compact('dokumen'));
    }

    public function edit(Dokuemen $dokumen)
    {
        return view('admin.dokumens.edit', compact('dokumen'));
    }

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

    public function download(Dokuemen $dokumen)
    {
        $dokumen->increment('jumlah_download');

        return Storage::disk('public')->download(
            $dokumen->file,
            $dokumen->nama_dokumen.'.'.pathinfo($dokumen->file, PATHINFO_EXTENSION)
        );
    }
}
