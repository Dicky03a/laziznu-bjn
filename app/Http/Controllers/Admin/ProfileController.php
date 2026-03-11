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
    public function index(): View
    {
        $profiles = Profile::latest()->get();

        return view('admin.profiles.index', compact('profiles'));
    }

    public function create(): View
    {
        return view('admin.profiles.create');
    }

    public function store(StoreProfileRequest $request): RedirectResponse
    {
        $profile = Profile::create($request->validated());

        if ($request->has('missions')) {
            foreach ($request->missions as $missionData) {
                $profile->missions()->create([
                    'text' => $missionData['text'],
                    'urutan' => $missionData['urutan'] ?? 0,
                ]);
            }
        }

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

    public function show(Profile $profile): View
    {
        $profile->load(['missions', 'pillars']);

        return view('admin.profiles.show', compact('profile'));
    }

    public function edit(Profile $profile): View
    {
        $profile->load(['missions', 'pillars']);

        return view('admin.profiles.edit', compact('profile'));
    }

    public function update(UpdateProfileRequest $request, Profile $profile): RedirectResponse
    {
        $profile->update($request->validated());

        $profile->missions()->delete();

        if ($request->has('missions')) {
            foreach ($request->missions as $missionData) {
                $profile->missions()->create([
                    'text' => $missionData['text'],
                    'urutan' => $missionData['urutan'] ?? 0,
                ]);
            }
        }

        $profile->pillars()->delete();

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

    public function destroy(Profile $profile): RedirectResponse
    {
        $profile->delete();

        return redirect()
            ->route('profiles.index')
            ->with('success', 'Profil berhasil dihapus');
    }
}
