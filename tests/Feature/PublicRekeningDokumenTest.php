<?php

use App\Models\Dokuemen;
use App\Models\Rekening;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    Cache::flush();
});

// ── REKENING PUBLIK ───────────────────────────────────────────────────────────

test('it shows the public rekening page', function () {
    $response = $this->get(route('rekening-lengkap'));

    $response->assertOk();
    $response->assertViewIs('pages.public.profil.rekeninglengkap');
    $response->assertViewHas('rekenings');
});

test('it passes all rekenings to the public rekening view', function () {
    Rekening::create(['nama' => 'BNI', 'bank_atas_nama' => 'LAZISNU', 'nomor_rekening' => '111']);
    Rekening::create(['nama' => 'BCA', 'bank_atas_nama' => 'LAZISNU', 'nomor_rekening' => '222']);

    $response = $this->get(route('rekening-lengkap'));

    $response->assertViewHas('rekenings', fn ($list) => $list->count() === 2);
});

test('it caches rekenings after first request', function () {
    Rekening::create(['nama' => 'BNI', 'bank_atas_nama' => 'LAZISNU', 'nomor_rekening' => '111']);

    $this->get(route('rekening-lengkap'));

    expect(Cache::has('public_rekenings_all'))->toBeTrue();
});

test('it serves cached rekenings on second request', function () {
    $rekening = Rekening::create(['nama' => 'BNI', 'bank_atas_nama' => 'LAZISNU', 'nomor_rekening' => '111']);

    $this->get(route('rekening-lengkap'));

    // Ubah DB langsung (bypass observer)
    Rekening::where('id', $rekening->id)->update(['nama' => 'BNI Berubah']);

    $response = $this->get(route('rekening-lengkap'));
    $response->assertViewHas('rekenings', fn ($list) => $list->first()->nama === 'BNI');
});

test('observer clears public_rekenings_all when rekening is saved', function () {
    $rekening = Rekening::create(['nama' => 'BNI', 'bank_atas_nama' => 'LAZISNU', 'nomor_rekening' => '111']);
    Cache::put('public_rekenings_all', 'cached', 60);

    $rekening->bank_atas_nama = 'Diubah';
    $rekening->save();

    expect(Cache::has('public_rekenings_all'))->toBeFalse();
});

test('observer clears public_rekenings_all when rekening is deleted', function () {
    $rekening = Rekening::create(['nama' => 'BNI', 'bank_atas_nama' => 'LAZISNU', 'nomor_rekening' => '111']);
    Cache::put('public_rekenings_all', 'cached', 60);

    $rekening->delete();

    expect(Cache::has('public_rekenings_all'))->toBeFalse();
});

// ── DOKUMEN PUBLIK ────────────────────────────────────────────────────────────

test('it shows the public dokumen page', function () {
    $response = $this->get(route('dokumen'));

    $response->assertOk();
    $response->assertViewIs('pages.public.profil.dokumen');
    $response->assertViewHas('dokumens');
});

test('it passes all dokumens to the public dokumen view', function () {
    Storage::fake('public');
    Storage::disk('public')->put('dokumens/a.pdf', 'content');
    Storage::disk('public')->put('dokumens/b.pdf', 'content');

    Dokuemen::create(['nama_dokumen' => 'Dok A', 'file' => 'dokumens/a.pdf', 'ukuran_file' => 100, 'jumlah_download' => 0]);
    Dokuemen::create(['nama_dokumen' => 'Dok B', 'file' => 'dokumens/b.pdf', 'ukuran_file' => 100, 'jumlah_download' => 0]);

    $response = $this->get(route('dokumen'));

    $response->assertViewHas('dokumens', fn ($list) => $list->count() === 2);
});

test('it caches dokumens after first request', function () {
    $this->get(route('dokumen'));

    expect(Cache::has('public_dokumens_all'))->toBeTrue();
});

test('observer clears public_dokumens_all when dokumen is saved', function () {
    Storage::fake('public');
    Storage::disk('public')->put('dokumens/test.pdf', 'content');

    $dokumen = Dokuemen::create([
        'nama_dokumen' => 'Laporan',
        'file' => 'dokumens/test.pdf',
        'ukuran_file' => 100,
        'jumlah_download' => 0,
    ]);
    Cache::put('public_dokumens_all', 'cached', 60);

    $dokumen->nama_dokumen = 'Diubah';
    $dokumen->save();

    expect(Cache::has('public_dokumens_all'))->toBeFalse();
});

test('observer clears public_dokumens_all when dokumen is deleted', function () {
    Storage::fake('public');
    Storage::disk('public')->put('dokumens/test.pdf', 'content');

    $dokumen = Dokuemen::create([
        'nama_dokumen' => 'Laporan',
        'file' => 'dokumens/test.pdf',
        'ukuran_file' => 100,
        'jumlah_download' => 0,
    ]);
    Cache::put('public_dokumens_all', 'cached', 60);

    $dokumen->delete();

    expect(Cache::has('public_dokumens_all'))->toBeFalse();
});
