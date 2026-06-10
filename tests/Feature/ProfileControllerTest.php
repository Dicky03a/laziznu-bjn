<?php

use App\Models\Missions;
use App\Models\Pillars;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

beforeEach(function () {
    $this->seed(Database\Seeders\RoleSeeder::class);
    $this->user = User::factory()->create();
    $this->user->assignRole('super-admin');
});

// ── EXISTING HAPPY-PATH ──────────────────────────────────────────────────────

test('it can update a profile with missions and pillars without mass assignment exception', function () {
    $profile = Profile::create([
        'title' => 'Initial Title',
        'deskripsi' => 'Initial Description',
    ]);

    $response = $this->actingAs($this->user)
        ->put(route('profiles.update', $profile), [
            'title' => 'Updated Title',
            'deskripsi' => 'Updated Description',
            'missions' => [
                ['text' => 'Mission 1', 'urutan' => 1],
                ['text' => 'Mission 2', 'urutan' => 2],
            ],
            'pillars' => [
                ['title' => 'Pillar 1', 'deskripsi' => 'Desc 1', 'urutan' => 1],
            ],
        ]);

    $response->assertRedirect(route('profiles.index'));
    $response->assertSessionHas('success', 'Profil berhasil diupdate');

    $profile->refresh();
    expect($profile->title)->toBe('Updated Title');
    expect($profile->missions)->toHaveCount(2);
    expect($profile->pillars)->toHaveCount(1);
});

test('it can store a profile with missions and pillars without mass assignment exception', function () {
    $response = $this->actingAs($this->user)
        ->post(route('profiles.store'), [
            'title' => 'New Profile',
            'deskripsi' => 'New Description',
            'missions' => [
                ['text' => 'New Mission', 'urutan' => 1],
            ],
            'pillars' => [
                ['title' => 'New Pillar', 'deskripsi' => 'New Desc', 'urutan' => 1],
            ],
        ]);

    $response->assertRedirect(route('profiles.index'));
    $response->assertSessionHas('success', 'Profil berhasil ditambahkan');

    $profile = Profile::where('title', 'New Profile')->first();
    expect($profile)->not->toBeNull();
    expect($profile->missions)->toHaveCount(1);
    expect($profile->pillars)->toHaveCount(1);
});

// ── INDEX ────────────────────────────────────────────────────────────────────

test('it shows the profile index page', function () {
    $response = $this->actingAs($this->user)->get(route('profiles.index'));

    $response->assertOk();
    $response->assertViewIs('admin.profiles.index');
    $response->assertViewHas('profiles');
});

// ── CREATE ───────────────────────────────────────────────────────────────────

test('it shows the create profile form', function () {
    $response = $this->actingAs($this->user)->get(route('profiles.create'));

    $response->assertOk();
    $response->assertViewIs('admin.profiles.create');
});

// ── STORE VALIDATION ─────────────────────────────────────────────────────────

test('it fails to store a profile without title', function () {
    $response = $this->actingAs($this->user)
        ->post(route('profiles.store'), [
            'title' => '',
            'deskripsi' => 'Deskripsi',
        ]);

    $response->assertSessionHasErrors('title');
});

test('it fails to store a profile when a mission text is empty', function () {
    $response = $this->actingAs($this->user)
        ->post(route('profiles.store'), [
            'title' => 'Profile Valid',
            'missions' => [
                ['text' => '', 'urutan' => 1],
            ],
        ]);

    $response->assertSessionHasErrors('missions.0.text');
});

test('it fails to store a profile when a pillar title is empty', function () {
    $response = $this->actingAs($this->user)
        ->post(route('profiles.store'), [
            'title' => 'Profile Valid',
            'pillars' => [
                ['title' => '', 'deskripsi' => 'Desc', 'urutan' => 1],
            ],
        ]);

    $response->assertSessionHasErrors('pillars.0.title');
});

test('it fails to store a profile when penerima_manfaat is not an integer', function () {
    $response = $this->actingAs($this->user)
        ->post(route('profiles.store'), [
            'title' => 'Profile Valid',
            'penerima_manfaat' => 'bukan angka',
        ]);

    $response->assertSessionHasErrors('penerima_manfaat');
});

// ── STORE EDGE CASES ─────────────────────────────────────────────────────────

test('it stores a profile without missions and pillars', function () {
    $response = $this->actingAs($this->user)
        ->post(route('profiles.store'), [
            'title' => 'Profile Tanpa Misi',
        ]);

    $response->assertRedirect(route('profiles.index'));

    $profile = Profile::where('title', 'Profile Tanpa Misi')->first();
    expect($profile)->not->toBeNull();
    expect($profile->missions)->toHaveCount(0);
    expect($profile->pillars)->toHaveCount(0);
});

test('it stores profile statistics correctly', function () {
    $this->actingAs($this->user)
        ->post(route('profiles.store'), [
            'title' => 'Profile Statistik',
            'tahun_berdiri' => '2015',
            'penerima_manfaat' => 5000,
            'program_tersalurkan' => 12,
            'visi' => 'Visi organisasi kami',
        ]);

    $profile = Profile::where('title', 'Profile Statistik')->first();
    expect($profile->tahun_berdiri)->toBe('2015');
    expect($profile->penerima_manfaat)->toBe(5000);
    expect($profile->program_tersalurkan)->toBe(12);
    expect($profile->visi)->toBe('Visi organisasi kami');
});

// ── SHOW ─────────────────────────────────────────────────────────────────────

test('it shows a profile detail page', function () {
    $profile = Profile::create(['title' => 'Profile Detail']);

    $response = $this->actingAs($this->user)->get(route('profiles.show', $profile));

    $response->assertOk();
    $response->assertViewIs('admin.profiles.show');
    $response->assertViewHas('profile', fn ($p) => $p->id === $profile->id);
});

// ── EDIT ─────────────────────────────────────────────────────────────────────

test('it shows the edit profile form with existing data', function () {
    $profile = Profile::create(['title' => 'Profile Edit']);

    $response = $this->actingAs($this->user)->get(route('profiles.edit', $profile));

    $response->assertOk();
    $response->assertViewIs('admin.profiles.edit');
    $response->assertViewHas('profile', fn ($p) => $p->id === $profile->id);
});

// ── UPDATE ───────────────────────────────────────────────────────────────────

test('it replaces missions and pillars lama when updating', function () {
    $profile = Profile::create(['title' => 'Profile Update']);
    $profile->missions()->create(['text' => 'Misi Lama', 'urutan' => 1]);
    $profile->pillars()->create(['title' => 'Pilar Lama', 'urutan' => 1]);

    $this->actingAs($this->user)
        ->put(route('profiles.update', $profile), [
            'title' => 'Profile Update',
            'missions' => [
                ['text' => 'Misi Baru', 'urutan' => 1],
                ['text' => 'Misi Baru Dua', 'urutan' => 2],
            ],
            'pillars' => [
                ['title' => 'Pilar Baru', 'deskripsi' => 'Deskripsi Baru', 'urutan' => 1],
            ],
        ]);

    $profile->refresh();
    expect($profile->missions)->toHaveCount(2);
    expect($profile->missions->first()->text)->toBe('Misi Baru');
    expect($profile->pillars)->toHaveCount(1);
    expect($profile->pillars->first()->title)->toBe('Pilar Baru');
});

test('it removes all missions and pillars when updating without sending them', function () {
    $profile = Profile::create(['title' => 'Profile Kosong']);
    $profile->missions()->create(['text' => 'Misi Lama', 'urutan' => 1]);
    $profile->pillars()->create(['title' => 'Pilar Lama', 'urutan' => 1]);

    $this->actingAs($this->user)
        ->put(route('profiles.update', $profile), [
            'title' => 'Profile Kosong',
        ]);

    $profile->refresh();
    expect($profile->missions)->toHaveCount(0);
    expect($profile->pillars)->toHaveCount(0);
});

test('it fails to update a profile without title', function () {
    $profile = Profile::create(['title' => 'Profile Valid']);

    $response = $this->actingAs($this->user)
        ->put(route('profiles.update', $profile), [
            'title' => '',
        ]);

    $response->assertSessionHasErrors('title');
});

// ── DESTROY ──────────────────────────────────────────────────────────────────

test('it can delete a profile', function () {
    $profile = Profile::create(['title' => 'Profile Hapus']);

    $response = $this->actingAs($this->user)
        ->delete(route('profiles.destroy', $profile));

    $response->assertRedirect(route('profiles.index'));
    $response->assertSessionHas('success', 'Profil berhasil dihapus');
    expect(Profile::find($profile->id))->toBeNull();
});

test('it cascades delete to missions and pillars', function () {
    $profile = Profile::create(['title' => 'Profile Cascade']);
    $mission = $profile->missions()->create(['text' => 'Misi Hapus', 'urutan' => 1]);
    $pillar = $profile->pillars()->create(['title' => 'Pilar Hapus', 'urutan' => 1]);

    $this->actingAs($this->user)
        ->delete(route('profiles.destroy', $profile));

    expect(Missions::find($mission->id))->toBeNull();
    expect(Pillars::find($pillar->id))->toBeNull();
});

// ── CACHE / OBSERVER ─────────────────────────────────────────────────────────

test('it clears cache when a profile is created via controller', function () {
    Cache::put('public_profile_latest', 'cached', 60);
    Cache::put('public_profile_full', 'cached', 60);

    $this->actingAs($this->user)
        ->post(route('profiles.store'), [
            'title' => 'Profile Cache Create',
        ]);

    expect(Cache::has('public_profile_latest'))->toBeFalse();
    expect(Cache::has('public_profile_full'))->toBeFalse();
});

test('it clears cache when a profile is updated via controller', function () {
    $profile = Profile::create(['title' => 'Profile Cache Update']);
    Cache::put('public_profile_latest', 'cached', 60);
    Cache::put('public_profile_full', 'cached', 60);

    $this->actingAs($this->user)
        ->put(route('profiles.update', $profile), [
            'title' => 'Profile Cache Updated',
        ]);

    expect(Cache::has('public_profile_latest'))->toBeFalse();
    expect(Cache::has('public_profile_full'))->toBeFalse();
});

test('it clears cache when a profile is deleted via controller', function () {
    $profile = Profile::create(['title' => 'Profile Cache Delete']);
    Cache::put('public_profile_latest', 'cached', 60);
    Cache::put('public_profile_full', 'cached', 60);

    $this->actingAs($this->user)
        ->delete(route('profiles.destroy', $profile));

    expect(Cache::has('public_profile_latest'))->toBeFalse();
    expect(Cache::has('public_profile_full'))->toBeFalse();
});
