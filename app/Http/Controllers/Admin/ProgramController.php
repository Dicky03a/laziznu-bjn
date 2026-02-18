<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index(Request $request)
    {
        $programs = Program::query()
            ->when($request->type, fn ($q) => $q->ofType($request->type))
            ->when($request->search, fn ($q) => $q->where('nama', 'like', '%'.$request->search.'%'))
            ->withCount(['confirmedTransactions as total_donatur'])
            ->withSum(['confirmedTransactions as total_terkumpul'], 'jumlah')
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.programs.index', compact('programs'));
    }

    public function create()
    {
        return view('admin.programs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => ['required', 'in:infaq,donasi'],
            'nama' => ['required', 'string', 'max:200'],
            'deskripsi' => ['required', 'string'],
            'konten' => ['nullable', 'string'],
            'thumbnail' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'target_dana' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['boolean'],
            'is_featured' => ['boolean'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
        ]);

        $validated['slug'] = Program::generateSlug($validated['nama']);
        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')
                ->store('programs/thumbnails', 'public');
        }

        Program::create($validated);

        return redirect()
            ->route('programs.index')
            ->with('success', 'Program berhasil ditambahkan.');
    }

    public function edit(Program $program)
    {
        return view('admin.programs.edit', compact('program'));
    }

    public function update(Request $request, Program $program)
    {
        $validated = $request->validate([
            'type' => ['required', 'in:infaq,donasi'],
            'nama' => ['required', 'string', 'max:200'],
            'deskripsi' => ['required', 'string'],
            'konten' => ['nullable', 'string'],
            'thumbnail' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'target_dana' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['boolean'],
            'is_featured' => ['boolean'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');
        $validated['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('thumbnail')) {
            // Hapus thumbnail lama
            if ($program->thumbnail) {
                \Storage::disk('public')->delete($program->thumbnail);
            }
            $validated['thumbnail'] = $request->file('thumbnail')
                ->store('programs/thumbnails', 'public');
        }

        $program->update($validated);

        return redirect()
            ->route('programs.index')
            ->with('success', 'Program berhasil diperbarui.');
    }

    public function destroy(Program $program)
    {
        $program->delete();

        return redirect()
            ->route('programs.index')
            ->with('success', 'Program berhasil dihapus.');
    }

    public function toggleActive(Program $program)
    {
        $program->update(['is_active' => ! $program->is_active]);

        return back()->with('success', 'Status program diperbarui.');
    }
}
