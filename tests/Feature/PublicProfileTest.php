<?php

use App\Models\Profile;
use Illuminate\Support\Facades\Cache;

beforeEach(function () {
    Cache::flush();
});

// ── PUBLIC PROFILE PAGE (/profile) ───────────────────────────────────────────

test('it shows the public profile page', function () {
    Profile::create(['title' => 'NU CARE Lazisnu']);

    $response = $this->get(route('profile'));

    $response->assertOk();
    $response->assertViewIs('pages.public.profil.profile');
});

test('it passes the latest profile to the public profile view', function () {
    // Use explicit past timestamp so `latest()` ordering is deterministic
    Profile::forceCreate(['title' => 'Profile Lama', 'created_at' => now()->subMinute(), 'updated_at' => now()->subMinute()]);
    $latest = Profile::create(['title' => 'Profile Terbaru']);

    $response = $this->get(route('profile'));

    $response->assertViewHas('profile', fn ($p) => $p->id === $latest->id);
});

test('it passes missions and pillars to the public profile view', function () {
    $profile = Profile::create(['title' => 'Profile dengan Relasi']);
    $profile->missions()->create(['text' => 'Misi Pertama', 'urutan' => 1]);
    $profile->pillars()->create(['title' => 'Pilar Pertama', 'urutan' => 1]);

    $response = $this->get(route('profile'));

    $response->assertViewHas('profile', function ($p) {
        return $p->missions->count() === 1
            && $p->pillars->count() === 1;
    });
});

test('it handles gracefully when no profile exists in the database', function () {
    // DB is empty — controller falls back to `new Profile()`
    $response = $this->get(route('profile'));

    $response->assertOk();
    $response->assertViewHas('profile');
});

// ── CACHING ──────────────────────────────────────────────────────────────────

test('it caches the profile result for the public page', function () {
    $profile = Profile::create(['title' => 'Profile Cached']);

    // First request populates the cache
    $this->get(route('profile'));
    expect(Cache::has('public_profile_full'))->toBeTrue();

    // Modify DB directly (bypasses Eloquent events → observer does not fire)
    Profile::where('id', $profile->id)->update(['title' => 'Profile Berubah di DB']);

    // Second request should return the cached (old) version
    $response = $this->get(route('profile'));
    $response->assertViewHas('profile', fn ($p) => $p->title === 'Profile Cached');
});

// ── OBSERVER ─────────────────────────────────────────────────────────────────

test('observer clears public_profile_full cache when a profile is saved', function () {
    $profile = Profile::create(['title' => 'Profile Observer Save']);
    Cache::put('public_profile_full', 'cached', 60);

    $profile->title = 'Profile Diubah';
    $profile->save();

    expect(Cache::has('public_profile_full'))->toBeFalse();
});

test('observer clears public_profile_latest cache when a profile is saved', function () {
    $profile = Profile::create(['title' => 'Profile Observer Latest']);
    Cache::put('public_profile_latest', 'cached', 60);

    $profile->title = 'Profile Diubah';
    $profile->save();

    expect(Cache::has('public_profile_latest'))->toBeFalse();
});

test('observer clears cache when a profile is deleted directly', function () {
    $profile = Profile::create(['title' => 'Profile Observer Delete']);
    Cache::put('public_profile_latest', 'cached', 60);
    Cache::put('public_profile_full', 'cached', 60);

    $profile->delete();

    expect(Cache::has('public_profile_latest'))->toBeFalse();
    expect(Cache::has('public_profile_full'))->toBeFalse();
});
