<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PengurusRequest;
use App\Models\Pengurus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PengurusController extends Controller
{
    public function index(Request $request): View
    {
        $query = Pengurus::query();

        // Filter pencarian
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('jabatan', 'like', "%{$search}%")
                    ->orWhere('bidang', 'like', "%{$search}%");
            });
        }

        // Filter jabatan
        if ($jabatan = $request->input('jabatan')) {
            $query->where('jabatan', $jabatan);
        }

        // Filter periode
        if ($periode = $request->input('periode')) {
            $query->where('masa_khidmat_mulai', $periode)
                ->orWhere('masa_khidmat_selesai', $periode);
        }

        // Filter status
        if ($request->filled('is_active')) {
            $query->where('is_active', $request->boolean('is_active'));
        }

        $pengurusList = $query->ordered()->paginate(15)->withQueryString();

        $jabatanList  = Pengurus::JABATAN_LIST;
        $periodeList  = Pengurus::distinct()
            ->orderBy('masa_khidmat_mulai')
            ->pluck('masa_khidmat_mulai')
            ->unique();

        return view('admin.pengurus.index', compact(
            'pengurusList',
            'jabatanList',
            'periodeList'
        ));
    }

    public function create(): View
    {
        $jabatanList = Pengurus::JABATAN_LIST;
        $bidangList  = Pengurus::BIDANG_LIST;

        return view('admin.pengurus.create', compact('jabatanList', 'bidangList'));
    }

    public function store(PengurusRequest $request): RedirectResponse
    {
        $data = $request->validated();

        // Handle upload foto
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')
                ->store('pengurus/foto', 'public');
        }

        $data['is_active'] = $request->boolean('is_active', true);

        Pengurus::create($data);

        return redirect()
            ->route('pengurus.index')
            ->with('success', 'Data pengurus berhasil ditambahkan.');
    }

    public function show(Pengurus $pengurus): View
    {
        return view('admin.pengurus.show', compact('pengurus'));
    }

    public function edit(Pengurus $pengurus): View
    {
        $jabatanList = Pengurus::JABATAN_LIST;
        $bidangList  = Pengurus::BIDANG_LIST;

        return view('admin.pengurus.edit', compact('pengurus', 'jabatanList', 'bidangList'));
    }

    public function update(PengurusRequest $request, Pengurus $pengurus): RedirectResponse
    {
        $data = $request->validated();

        // Handle foto baru
        if ($request->hasFile('foto')) {
            // Hapus foto lama
            if ($pengurus->foto) {
                Storage::disk('public')->delete($pengurus->foto);
            }
            $data['foto'] = $request->file('foto')
                ->store('pengurus/foto', 'public');
        }

        $data['is_active'] = $request->boolean('is_active');

        $pengurus->update($data);

        return redirect()
            ->route('pengurus.index')
            ->with('success', 'Data pengurus berhasil diperbarui.');
    }

    public function destroy(Pengurus $pengurus): RedirectResponse
    {
        // Soft delete – foto tetap ada
        $pengurus->delete();

        return redirect()
            ->route('pengurus.index')
            ->with('success', 'Data pengurus berhasil dihapus.');
    }

    public function toggleStatus(Pengurus $pengurus): RedirectResponse
    {
        $pengurus->update(['is_active' => ! $pengurus->is_active]);

        $status = $pengurus->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return back()->with('success', "Pengurus berhasil {$status}.");
    }

    public function destroyFoto(Pengurus $pengurus): RedirectResponse
    {
        if ($pengurus->foto) {
            Storage::disk('public')->delete($pengurus->foto);
            $pengurus->update(['foto' => null]);
        }

        return back()->with('success', 'Foto berhasil dihapus.');
    }
}
