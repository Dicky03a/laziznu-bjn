<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DistributionProgramRequest;
use App\Models\DistributionProgram;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DistributionProgramController extends Controller
{
    public function index(Request $request)
    {
        $distributionPrograms = DistributionProgram::query()
            ->with('sourceProgram.confirmedTransactions', 'sourceProgram.distributions')
            ->when($request->search, fn ($q) => $q->where('nama', 'like', '%'.$request->search.'%'))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        // Get source programs (infaq, donasi, zakat)
        $sourcePrograms = Program::whereIn('type', ['infaq', 'donasi', 'zakat'])
            ->with('confirmedTransactions', 'distributions')
            ->get();

        // Calculate statistics from source programs
        $totalTerkumpul = $sourcePrograms->sum(fn ($p) => $p->total_terkumpul);
        $totalDialokasikan = DistributionProgram::sum('target_dana');
        $totalSisa = max(0, $totalTerkumpul - $totalDialokasikan);
        $percentageAllocated = $totalTerkumpul > 0 ? round(($totalDialokasikan / $totalTerkumpul) * 100, 1) : 0;
        $programAktif = $sourcePrograms->where('is_active', true)->count();

        return view('admin.distribution-programs.index', compact(
            'distributionPrograms',
            'totalTerkumpul',
            'totalDialokasikan',
            'totalSisa',
            'percentageAllocated',
            'programAktif'
        ));
    }

    public function create()
    {
        $sourcePrograms = Program::active()
            ->whereIn('type', ['infaq', 'donasi', 'zakat'])
            ->withSum('confirmedTransactions as total_terkumpul', 'jumlah')
            ->withSum('distributions as total_distributed', 'target_dana')
            ->get();

        return view('admin.distribution-programs.create', compact('sourcePrograms'));
    }

    public function store(DistributionProgramRequest $request)
    {
        $validated = $request->validated();
        $sourceProgram = Program::findOrFail($validated['source_program_id']);

        $this->ensureSourceHasEnoughFunds($sourceProgram, $validated['target_dana']);

        $validated['slug'] = DistributionProgram::generateSlug($validated['nama']);
        $validated['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')
                ->store('distribution-programs/thumbnails', 'public');
        }

        DistributionProgram::create($validated);

        return redirect()
            ->route('distribution-programs.index')
            ->with('success', 'Program distribusi berhasil ditambahkan.');
    }

    public function edit(DistributionProgram $distributionProgram)
    {
        $sourcePrograms = Program::active()
            ->whereIn('type', ['infaq', 'donasi', 'zakat'])
            ->withSum('confirmedTransactions as total_terkumpul', 'jumlah')
            ->withSum('distributions as total_distributed', 'target_dana')
            ->get();

        return view('admin.distribution-programs.edit', compact('distributionProgram', 'sourcePrograms'));
    }

    public function update(DistributionProgramRequest $request, DistributionProgram $distributionProgram)
    {
        $validated = $request->validated();
        $sourceProgram = Program::findOrFail($validated['source_program_id']);

        $this->ensureSourceHasEnoughFunds($sourceProgram, $validated['target_dana'], $distributionProgram);

        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('thumbnail')) {
            if ($distributionProgram->thumbnail) {
                Storage::disk('public')->delete($distributionProgram->thumbnail);
            }
            $validated['thumbnail'] = $request->file('thumbnail')
                ->store('distribution-programs/thumbnails', 'public');
        }

        $distributionProgram->update($validated);

        return redirect()
            ->route('distribution-programs.index')
            ->with('success', 'Program distribusi berhasil diperbarui.');
    }

    public function destroy(DistributionProgram $distributionProgram)
    {
        if ($distributionProgram->thumbnail) {
            Storage::disk('public')->delete($distributionProgram->thumbnail);
        }

        $distributionProgram->delete();

        return redirect()
            ->route('distribution-programs.index')
            ->with('success', 'Program distribusi berhasil dihapus.');
    }

    public function toggleActive(DistributionProgram $distributionProgram)
    {
        $distributionProgram->update(['is_active' => ! $distributionProgram->is_active]);

        return back()->with('success', 'Status program distribusi diperbarui.');
    }

    protected function ensureSourceHasEnoughFunds(Program $sourceProgram, int $targetDana, ?DistributionProgram $ignore = null): void
    {
        $available = $sourceProgram->available_for_distribution;

        if ($ignore && $ignore->source_program_id === $sourceProgram->id) {
            $available += $ignore->target_dana;
        }

        if ($targetDana > $available) {
            abort(422, 'Target dana melebihi sisa dana yang tersedia dari sumber program.');
        }
    }
}
