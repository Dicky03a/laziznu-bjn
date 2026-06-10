<?php

use App\Models\Pengurus;
use Illuminate\Support\Facades\Cache;

beforeEach(function () {
    Cache::flush();

    $this->valid = [
        'nama' => 'Ahmad Fulan',
        'jabatan' => 'Ketua',
        'urutan' => 1,
        'masa_khidmat_mulai' => 2024,
        'masa_khidmat_selesai' => 2027,
        'is_active' => true,
    ];
});

// ── PUBLIC PENGURUS PAGE ──────────────────────────────────────────────────────

test('it shows the public pengurus page', function () {
    $response = $this->get(route('pengurus-laziznu-bojonegoro'));

    $response->assertOk();
    $response->assertViewIs('pages.public.profil.pengurus');
    $response->assertViewHas(['pengurusByJabatan', 'periodeAktif', 'noSk']);
});

test('it passes pengurusByJabatan grouped by jabatan to the view', function () {
    Pengurus::create($this->valid); // Ketua
    Pengurus::create([...$this->valid, 'nama' => 'Siti Aminah', 'jabatan' => 'Sekretaris']);

    $response = $this->get(route('pengurus-laziznu-bojonegoro'));

    $response->assertViewHas('pengurusByJabatan', fn ($grouped) =>
        $grouped->has('Ketua') && $grouped->has('Sekretaris')
    );
});

test('it passes periodeAktif for the most recent active period', function () {
    Pengurus::create($this->valid); // masa_khidmat_mulai=2024, selesai=2027

    $response = $this->get(route('pengurus-laziznu-bojonegoro'));

    $response->assertViewHas('periodeAktif', fn ($p) =>
        $p->masa_khidmat_mulai == 2024 && $p->masa_khidmat_selesai == 2027
    );
});

test('it does not show inactive pengurus on the public page', function () {
    Pengurus::create([...$this->valid, 'is_active' => false]);

    $response = $this->get(route('pengurus-laziznu-bojonegoro'));

    $response->assertViewHas('pengurusByJabatan', fn ($grouped) => $grouped->isEmpty());
});

test('it handles gracefully when no pengurus exists', function () {
    // DB kosong — periodeAktif null, pengurusByJabatan empty
    $response = $this->get(route('pengurus-laziznu-bojonegoro'));

    $response->assertOk();
    $response->assertViewHas('periodeAktif', null);
});

// ── CACHING ───────────────────────────────────────────────────────────────────

test('it populates all three cache keys after first request', function () {
    // no_sk harus non-null agar Cache::remember benar-benar menyimpannya
    // (Cache::remember tidak menyimpan nilai null)
    Pengurus::create([...$this->valid, 'no_sk' => 'SK-001/2024']);

    $this->get(route('pengurus-laziznu-bojonegoro'));

    expect(Cache::has('public_pengurus_periode_aktif'))->toBeTrue();
    expect(Cache::has('public_pengurus_by_jabatan'))->toBeTrue();
    expect(Cache::has('public_pengurus_no_sk'))->toBeTrue();
});

test('it serves cached data on second request without reading updated DB', function () {
    $pengurus = Pengurus::create($this->valid);

    // Request pertama → cache terisi
    $this->get(route('pengurus-laziznu-bojonegoro'));

    // Ubah DB langsung (bypass observer → cache tidak dikosongkan)
    Pengurus::where('id', $pengurus->id)->update(['nama' => 'Nama Berubah di DB']);

    // Request kedua → data dari cache (nama lama)
    $response = $this->get(route('pengurus-laziznu-bojonegoro'));
    $response->assertViewHas('pengurusByJabatan', fn ($grouped) =>
        $grouped->flatten()->first()->nama === 'Ahmad Fulan'
    );
});

// ── OBSERVER ─────────────────────────────────────────────────────────────────

test('observer clears all three cache keys when a pengurus is saved', function () {
    $pengurus = Pengurus::create($this->valid);
    Cache::put('public_pengurus_periode_aktif', 'cached', 60);
    Cache::put('public_pengurus_by_jabatan', 'cached', 60);
    Cache::put('public_pengurus_no_sk', 'cached', 60);

    $pengurus->nama = 'Nama Diubah';
    $pengurus->save();

    expect(Cache::has('public_pengurus_periode_aktif'))->toBeFalse();
    expect(Cache::has('public_pengurus_by_jabatan'))->toBeFalse();
    expect(Cache::has('public_pengurus_no_sk'))->toBeFalse();
});

test('observer clears all three cache keys when a pengurus is deleted', function () {
    $pengurus = Pengurus::create($this->valid);
    Cache::put('public_pengurus_periode_aktif', 'cached', 60);
    Cache::put('public_pengurus_by_jabatan', 'cached', 60);
    Cache::put('public_pengurus_no_sk', 'cached', 60);

    $pengurus->delete();

    expect(Cache::has('public_pengurus_periode_aktif'))->toBeFalse();
    expect(Cache::has('public_pengurus_by_jabatan'))->toBeFalse();
    expect(Cache::has('public_pengurus_no_sk'))->toBeFalse();
});
