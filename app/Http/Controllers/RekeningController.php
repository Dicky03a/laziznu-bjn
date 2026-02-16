<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRekeningRequest;
use App\Http\Requests\UpdateRekeningRequest;
use App\Models\Rekening;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RekeningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rekenings = Rekening::latest()->paginate(10);

        return view('admin.rekenings.index', compact('rekenings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.rekenings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRekeningRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('rekenings', 'public');
        }

        Rekening::create($data);

        return redirect()->route('rekenings.index')->with('success', 'Rekening berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rekening $rekening)
    {
        return view('admin.rekenings.show', compact('rekening'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rekening $rekening)
    {
        return view('admin.rekenings.edit', compact('rekening'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRekeningRequest $request, Rekening $rekening)
    {
        $data = $request->validated();

        if ($request->hasFile('icon')) {

            // Hapus icon lama jika ada
            if ($rekening->icon && Storage::disk('public')->exists($rekening->icon)) {
                Storage::disk('public')->delete($rekening->icon);
            }

            // Simpan icon baru dengan nama unik
            $file = $request->file('icon');

            $data['icon'] = $file->storeAs(
                'rekenings',
                Str::uuid() . '.' . $file->getClientOriginalExtension(),
                'public'
            );
        }

        $rekening->update($data);

        return redirect()
            ->route('rekenings.index')
            ->with('success', 'Rekening berhasil diperbarui');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rekening $rekening)
    {
        if ($rekening->icon) {
            Storage::disk('public')->delete($rekening->icon);
        }

        $rekening->delete();

        return redirect()->route('rekenings.index')->with('success', 'Rekening berhasil dihapus');
    }
}
