<?php

use App\Models\LaporanTahunan;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

beforeEach(function () {
    $this->seed(Database\Seeders\RoleSeeder::class);
    $this->user = User::factory()->create();
    $this->user->assignRole('super-admin');

    $this->valid = [
        'nama' => 'Laporan Tahunan 2024',
        'link_from' => 'https://drive.google.com/file/abc123',
    ];
});

function createLaporanTahunan(array $attrs = []): LaporanTahunan
{
    return LaporanTahunan::create(array_merge([
        'nama' => 'Laporan Tahunan 2024',
        'link_from' => 'https://drive.google.com/file/abc123',
    ], $attrs));
}

// ── INDEX ─────────────────────────────────────────────────────────────────────

test('it shows the laporan tahunan index page', function () {
    $response = $this->actingAs($this->user)->get(route('laporan-tahunans.index'));

    $response->assertOk();
    $response->assertViewIs('admin.laporan-tahunan.index');
    $response->assertViewHas('laporanTahunans');
});

// ── CREATE ────────────────────────────────────────────────────────────────────

test('it shows the create laporan tahunan form', function () {
    $response = $this->actingAs($this->user)->get(route('laporan-tahunans.create'));

    $response->assertOk();
    $response->assertViewIs('admin.laporan-tahunan.create');
});

// ── STORE VALIDATION ──────────────────────────────────────────────────────────

test('it fails to store without nama', function () {
    $response = $this->actingAs($this->user)
        ->post(route('laporan-tahunans.store'), [...$this->valid, 'nama' => '']);

    $response->assertSessionHasErrors('nama');
});

test('it fails to store without link_from', function () {
    $response = $this->actingAs($this->user)
        ->post(route('laporan-tahunans.store'), [...$this->valid, 'link_from' => '']);

    $response->assertSessionHasErrors('link_from');
});

test('it fails to store with duplicate nama', function () {
    createLaporanTahunan();

    $response = $this->actingAs($this->user)
        ->post(route('laporan-tahunans.store'), $this->valid);

    $response->assertSessionHasErrors('nama');
});

// ── STORE HAPPY PATH ──────────────────────────────────────────────────────────

test('it stores a laporan tahunan', function () {
    $response = $this->actingAs($this->user)
        ->post(route('laporan-tahunans.store'), $this->valid);

    $response->assertRedirect(route('laporan-tahunans.index'));
    $response->assertSessionHas('success');

    $laporan = LaporanTahunan::where('nama', 'Laporan Tahunan 2024')->first();
    expect($laporan)->not->toBeNull();
    expect($laporan->link_from)->toBe('https://drive.google.com/file/abc123');
});

// ── SHOW ──────────────────────────────────────────────────────────────────────

test('it shows a laporan tahunan detail page', function () {
    $laporan = createLaporanTahunan();

    $response = $this->actingAs($this->user)->get(route('laporan-tahunans.show', $laporan));

    $response->assertOk();
    $response->assertViewIs('admin.laporan-tahunan.show');
    $response->assertViewHas('laporanTahunan', fn ($l) => $l->id === $laporan->id);
});

// ── EDIT ──────────────────────────────────────────────────────────────────────

test('it shows the edit laporan tahunan form', function () {
    $laporan = createLaporanTahunan();

    $response = $this->actingAs($this->user)->get(route('laporan-tahunans.edit', $laporan));

    $response->assertOk();
    $response->assertViewIs('admin.laporan-tahunan.edit');
    $response->assertViewHas('laporanTahunan', fn ($l) => $l->id === $laporan->id);
});

// ── UPDATE ────────────────────────────────────────────────────────────────────

test('it updates laporan tahunan data', function () {
    $laporan = createLaporanTahunan();

    $this->actingAs($this->user)
        ->put(route('laporan-tahunans.update', $laporan), [
            'nama' => 'Laporan Tahunan 2025',
            'link_from' => 'https://drive.google.com/file/xyz789',
        ]);

    $laporan->refresh();
    expect($laporan->nama)->toBe('Laporan Tahunan 2025');
    expect($laporan->link_from)->toBe('https://drive.google.com/file/xyz789');
});

test('update redirects to show page (bukan index)', function () {
    $laporan = createLaporanTahunan();

    $response = $this->actingAs($this->user)
        ->put(route('laporan-tahunans.update', $laporan), $this->valid);

    $response->assertRedirect(route('laporan-tahunans.show', $laporan));
});

test('it can update laporan without changing nama (self-ignore unique)', function () {
    $laporan = createLaporanTahunan();

    $response = $this->actingAs($this->user)
        ->put(route('laporan-tahunans.update', $laporan), $this->valid);

    $response->assertSessionHasNoErrors();
});

test('it fails to update with duplicate nama of another laporan', function () {
    createLaporanTahunan(['nama' => 'Laporan Lain']);
    $laporan = createLaporanTahunan(['nama' => 'Laporan Ini']);

    $response = $this->actingAs($this->user)
        ->put(route('laporan-tahunans.update', $laporan), [
            'nama' => 'Laporan Lain',
            'link_from' => 'https://link.com',
        ]);

    $response->assertSessionHasErrors('nama');
});

// ── DESTROY ───────────────────────────────────────────────────────────────────

test('it deletes a laporan tahunan', function () {
    $laporan = createLaporanTahunan();

    $response = $this->actingAs($this->user)
        ->delete(route('laporan-tahunans.destroy', $laporan));

    $response->assertRedirect(route('laporan-tahunans.index'));
    $response->assertSessionHas('success');
    expect(LaporanTahunan::find($laporan->id))->toBeNull();
});

// ── CACHE / OBSERVER ──────────────────────────────────────────────────────────

test('it clears cache when laporan tahunan is created via controller', function () {
    Cache::put('public_laporan_tahunan_all', 'cached', 60);

    $this->actingAs($this->user)->post(route('laporan-tahunans.store'), $this->valid);

    expect(Cache::has('public_laporan_tahunan_all'))->toBeFalse();
});

test('it clears cache when laporan tahunan is updated via controller', function () {
    $laporan = createLaporanTahunan();
    Cache::put('public_laporan_tahunan_all', 'cached', 60);

    $this->actingAs($this->user)
        ->put(route('laporan-tahunans.update', $laporan), [
            'nama' => 'Nama Updated',
            'link_from' => 'https://link-baru.com',
        ]);

    expect(Cache::has('public_laporan_tahunan_all'))->toBeFalse();
});

test('it clears cache when laporan tahunan is deleted via controller', function () {
    $laporan = createLaporanTahunan();
    Cache::put('public_laporan_tahunan_all', 'cached', 60);

    $this->actingAs($this->user)->delete(route('laporan-tahunans.destroy', $laporan));

    expect(Cache::has('public_laporan_tahunan_all'))->toBeFalse();
});

test('observer clears cache on direct save', function () {
    $laporan = createLaporanTahunan();
    Cache::put('public_laporan_tahunan_all', 'cached', 60);

    $laporan->nama = 'Diubah Langsung';
    $laporan->save();

    expect(Cache::has('public_laporan_tahunan_all'))->toBeFalse();
});

test('observer clears cache on direct delete', function () {
    $laporan = createLaporanTahunan();
    Cache::put('public_laporan_tahunan_all', 'cached', 60);

    $laporan->delete();

    expect(Cache::has('public_laporan_tahunan_all'))->toBeFalse();
});

// ── PUBLIC PAGE ───────────────────────────────────────────────────────────────

test('public laporan tahunan page is accessible', function () {
    $response = $this->get(route('laporan-tahunan.public'));

    $response->assertOk();
    $response->assertViewIs('pages.public.laporan.laporantahunan');
    $response->assertViewHas('laporanTahunans');
});

test('public page passes all laporan tahunan to the view', function () {
    createLaporanTahunan(['nama' => 'Laporan 2023']);
    createLaporanTahunan(['nama' => 'Laporan 2024']);

    $response = $this->get(route('laporan-tahunan.public'));

    $response->assertViewHas('laporanTahunans', fn ($list) => $list->count() === 2);
});

test('public page caches laporan tahunan after first request', function () {
    Cache::flush();

    $this->get(route('laporan-tahunan.public'));

    expect(Cache::has('public_laporan_tahunan_all'))->toBeTrue();
});
