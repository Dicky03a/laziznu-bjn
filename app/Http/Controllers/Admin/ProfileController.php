<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Profile;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * List profil
     */
    public function index(): View
    {
        $profiles = Profile::latest()->get();

        return view('admin.profiles.index', compact('profiles'));
    }

    /**
     * Form create
     */
    public function create(): View
    {
        return view('admin.profiles.create');
    }

    /**
     * Simpan profil
     */
    public function store(StoreProfileRequest $request): RedirectResponse
    {
        // Create profile
        $profile = Profile::create($request->validated());

        // Save missions if exists
        if ($request->has('missions')) {
            foreach ($request->missions as $missionData) {
                $profile->missions()->create([
                    'text' => $missionData['text'],
                    'urutan' => $missionData['urutan'] ?? 0,
                ]);
            }
        }

        // Save pillars if exists
        if ($request->has('pillars')) {
            foreach ($request->pillars as $pillarData) {
                $profile->pillars()->create([
                    'title' => $pillarData['title'],
                    'deskripsi' => $pillarData['deskripsi'] ?? null,
                    'urutan' => $pillarData['urutan'] ?? 0,
                ]);
            }
        }

        return redirect()
            ->route('profiles.index')
            ->with('success', 'Profil berhasil ditambahkan');
    }

    /**
     * Detail profil
     */
    public function show(Profile $profile): View
    {
        $profile->load(['missions', 'pillars']);

        return view('admin.profiles.show', compact('profile'));
    }

    /**
     * Form edit
     */
    public function edit(Profile $profile): View
    {
        $profile->load(['missions', 'pillars']);

        return view('admin.profiles.edit', compact('profile'));
    }

    /**
     * Update profil
     */
    public function update(UpdateProfileRequest $request, Profile $profile): RedirectResponse
    {
        // Update profile
        $profile->update($request->validated());

        // Sync missions
        // Delete all existing missions
        $profile->missions()->delete();

        // Create new missions
        if ($request->has('missions')) {
            foreach ($request->missions as $missionData) {
                $profile->missions()->create([
                    'text' => $missionData['text'],
                    'urutan' => $missionData['urutan'] ?? 0,
                ]);
            }
        }

        // Sync pillars
        // Delete all existing pillars
        $profile->pillars()->delete();

        // Create new pillars
        if ($request->has('pillars')) {
            foreach ($request->pillars as $pillarData) {
                $profile->pillars()->create([
                    'title' => $pillarData['title'],
                    'deskripsi' => $pillarData['deskripsi'] ?? null,
                    'urutan' => $pillarData['urutan'] ?? 0,
                ]);
            }
        }

        return redirect()
            ->route('profiles.index')
            ->with('success', 'Profil berhasil diupdate');
    }

    /**
     * Hapus profil
     */
    public function destroy(Profile $profile): RedirectResponse
    {
        // Missions and pillars will be deleted automatically due to cascadeOnDelete in migration
        $profile->delete();

        return redirect()
            ->route('profiles.index')
            ->with('success', 'Profil berhasil dihapus');
    }
}
