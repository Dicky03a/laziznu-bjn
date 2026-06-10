<?php

use App\Models\LaporanBulanan;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    $this->seed(Database\Seeders\RoleSeeder::class);
    $this->user = User::factory()->create();
    $this->user->assignRole('super-admin');
});

/**
 * Buat record LaporanBulanan langsung di DB dengan file palsu di storage.
 * file_laporan menyimpan hanya filename (bukan path lengkap).
 */
function createLaporanBulanan(array $attrs = []): LaporanBulanan
{
    Storage::disk('public')->put('laporan-bulanan/test.pdf', '%PDF-1.4 fake');

    return LaporanBulanan::create(array_merge([
        'nama_laporan' => 'Laporan Januari 2024',
        'file_laporan' => 'test.pdf',
    ], $attrs));
}

// ── INDEX ─────────────────────────────────────────────────────────────────────

test('it shows the laporan bulanan index page', function () {
    $response = $this->actingAs($this->user)->get(route('laporan-bulanan.index'));

    $response->assertOk();
    $response->assertViewIs('admin.laporan-bulanan.index');
    $response->assertViewHas('laporanBulanans');
});

// ── CREATE ────────────────────────────────────────────────────────────────────

test('it shows the create laporan bulanan form', function () {
    $response = $this->actingAs($this->user)->get(route('laporan-bulanan.create'));

    $response->assertOk();
    $response->assertViewIs('admin.laporan-bulanan.create');
});

// ── STORE VALIDATION ──────────────────────────────────────────────────────────

test('it fails to store without nama_laporan', function () {
    Storage::fake('public');

    $response = $this->actingAs($this->user)
        ->post(route('laporan-bulanan.store'), [
            'nama_laporan' => '',
            'file_laporan' => fakePdf(),
        ]);

    $response->assertSessionHasErrors('nama_laporan');
});

test('it fails to store without file_laporan', function () {
    $response = $this->actingAs($this->user)
        ->post(route('laporan-bulanan.store'), [
            'nama_laporan' => 'Laporan Januari',
        ]);

    $response->assertSessionHasErrors('file_laporan');
});

test('it fails to store with non-PDF file', function () {
    Storage::fake('public');

    $response = $this->actingAs($this->user)
        ->post(route('laporan-bulanan.store'), [
            'nama_laporan' => 'Laporan Januari',
            'file_laporan' => UploadedFile::fake()->image('photo.jpg'),
        ]);

    $response->assertSessionHasErrors('file_laporan');
});

// ── STORE HAPPY PATH ──────────────────────────────────────────────────────────

test('it stores a laporan bulanan with PDF file', function () {
    Storage::fake('public');

    $response = $this->actingAs($this->user)
        ->post(route('laporan-bulanan.store'), [
            'nama_laporan' => 'Laporan Februari 2024',
            'file_laporan' => fakePdf('februari.pdf'),
        ]);

    $response->assertRedirect(route('laporan-bulanan.index'));
    $response->assertSessionHas('success');

    $laporan = LaporanBulanan::where('nama_laporan', 'Laporan Februari 2024')->first();
    expect($laporan)->not->toBeNull();
});

test('it stores only filename in file_laporan column (not full path)', function () {
    Storage::fake('public');

    $this->actingAs($this->user)
        ->post(route('laporan-bulanan.store'), [
            'nama_laporan' => 'Laporan Maret 2024',
            'file_laporan' => fakePdf('maret.pdf'),
        ]);

    $laporan = LaporanBulanan::where('nama_laporan', 'Laporan Maret 2024')->first();
    // Harus hanya filename, tidak boleh mengandung direktori
    expect($laporan->file_laporan)->not->toContain('/');
    expect($laporan->file_laporan)->toEndWith('.pdf');
});

test('it saves the PDF file under laporan-bulanan directory in public storage', function () {
    Storage::fake('public');

    $this->actingAs($this->user)
        ->post(route('laporan-bulanan.store'), [
            'nama_laporan' => 'Laporan April 2024',
            'file_laporan' => fakePdf('april.pdf'),
        ]);

    $laporan = LaporanBulanan::where('nama_laporan', 'Laporan April 2024')->first();
    Storage::disk('public')->assertExists('laporan-bulanan/' . $laporan->file_laporan);
});

// ── SHOW ──────────────────────────────────────────────────────────────────────

test('it shows a laporan bulanan detail page', function () {
    Storage::fake('public');
    $laporan = createLaporanBulanan();

    $response = $this->actingAs($this->user)->get(route('laporan-bulanan.show', $laporan));

    $response->assertOk();
    $response->assertViewIs('admin.laporan-bulanan.show');
    $response->assertViewHas('laporanBulanan', fn ($l) => $l->id === $laporan->id);
});

// ── EDIT ──────────────────────────────────────────────────────────────────────

test('it shows the edit laporan bulanan form', function () {
    Storage::fake('public');
    $laporan = createLaporanBulanan();

    $response = $this->actingAs($this->user)->get(route('laporan-bulanan.edit', $laporan));

    $response->assertOk();
    $response->assertViewIs('admin.laporan-bulanan.edit');
    $response->assertViewHas('laporanBulanan', fn ($l) => $l->id === $laporan->id);
});

// ── UPDATE ────────────────────────────────────────────────────────────────────

test('it updates nama_laporan without replacing file', function () {
    Storage::fake('public');
    $laporan = createLaporanBulanan(['nama_laporan' => 'Nama Lama']);

    $this->actingAs($this->user)
        ->put(route('laporan-bulanan.update', $laporan), [
            'nama_laporan' => 'Nama Baru',
        ]);

    expect($laporan->fresh()->nama_laporan)->toBe('Nama Baru');
    expect($laporan->fresh()->file_laporan)->toBe('test.pdf'); // file tidak berubah
});

test('it replaces file lama when updating with file baru', function () {
    Storage::fake('public');
    $laporan = createLaporanBulanan();
    $fileLama = $laporan->file_laporan;

    $this->actingAs($this->user)
        ->put(route('laporan-bulanan.update', $laporan), [
            'nama_laporan' => $laporan->nama_laporan,
            'file_laporan' => fakePdf('baru.pdf'),
        ]);

    $laporan->refresh();
    expect($laporan->file_laporan)->not->toBe($fileLama);
    Storage::disk('public')->assertMissing('laporan-bulanan/' . $fileLama);
    Storage::disk('public')->assertExists('laporan-bulanan/' . $laporan->file_laporan);
});

test('it fails to update with non-PDF file', function () {
    Storage::fake('public');
    $laporan = createLaporanBulanan();

    $response = $this->actingAs($this->user)
        ->put(route('laporan-bulanan.update', $laporan), [
            'nama_laporan' => $laporan->nama_laporan,
            'file_laporan' => UploadedFile::fake()->image('photo.jpg'),
        ]);

    $response->assertSessionHasErrors('file_laporan');
});

// ── DESTROY ───────────────────────────────────────────────────────────────────

test('it deletes a laporan bulanan', function () {
    Storage::fake('public');
    $laporan = createLaporanBulanan();

    $response = $this->actingAs($this->user)
        ->delete(route('laporan-bulanan.destroy', $laporan));

    $response->assertRedirect(route('laporan-bulanan.index'));
    $response->assertSessionHas('success');
    expect(LaporanBulanan::find($laporan->id))->toBeNull();
});

test('it deletes file from storage when destroying laporan', function () {
    Storage::fake('public');
    $laporan = createLaporanBulanan();

    $this->actingAs($this->user)
        ->delete(route('laporan-bulanan.destroy', $laporan));

    Storage::disk('public')->assertMissing('laporan-bulanan/test.pdf');
});

// ── CACHE / OBSERVER ──────────────────────────────────────────────────────────

test('it clears cache when laporan is created via controller', function () {
    Storage::fake('public');
    Cache::put('public_laporan_bulanan_all', 'cached', 60);

    $this->actingAs($this->user)
        ->post(route('laporan-bulanan.store'), [
            'nama_laporan' => 'Laporan Cache',
            'file_laporan' => fakePdf(),
        ]);

    expect(Cache::has('public_laporan_bulanan_all'))->toBeFalse();
});

test('it clears cache when laporan is updated via controller', function () {
    Storage::fake('public');
    $laporan = createLaporanBulanan();
    Cache::put('public_laporan_bulanan_all', 'cached', 60);

    $this->actingAs($this->user)
        ->put(route('laporan-bulanan.update', $laporan), [
            'nama_laporan' => 'Nama Updated',
        ]);

    expect(Cache::has('public_laporan_bulanan_all'))->toBeFalse();
});

test('it clears cache when laporan is deleted via controller', function () {
    Storage::fake('public');
    $laporan = createLaporanBulanan();
    Cache::put('public_laporan_bulanan_all', 'cached', 60);

    $this->actingAs($this->user)
        ->delete(route('laporan-bulanan.destroy', $laporan));

    expect(Cache::has('public_laporan_bulanan_all'))->toBeFalse();
});

test('observer clears cache on direct save', function () {
    Storage::fake('public');
    $laporan = createLaporanBulanan();
    Cache::put('public_laporan_bulanan_all', 'cached', 60);

    $laporan->nama_laporan = 'Diubah Langsung';
    $laporan->save();

    expect(Cache::has('public_laporan_bulanan_all'))->toBeFalse();
});

test('observer clears cache on direct delete', function () {
    Storage::fake('public');
    $laporan = createLaporanBulanan();
    Cache::put('public_laporan_bulanan_all', 'cached', 60);

    $laporan->delete();

    expect(Cache::has('public_laporan_bulanan_all'))->toBeFalse();
});

// ── PUBLIC PAGE ───────────────────────────────────────────────────────────────

test('public laporan bulanan page is accessible', function () {
    $response = $this->get(route('laporan-bulanan.public'));

    $response->assertOk();
    $response->assertViewIs('pages.public.laporan.laporanbulanan');
    $response->assertViewHas('laporanBulanan');
});

test('public page passes all laporan to the view', function () {
    Storage::fake('public');
    createLaporanBulanan(['nama_laporan' => 'Laporan A']);
    createLaporanBulanan(['nama_laporan' => 'Laporan B']);

    $response = $this->get(route('laporan-bulanan.public'));

    $response->assertViewHas('laporanBulanan', fn ($list) => $list->count() === 2);
});

test('public page caches laporan after first request', function () {
    Cache::flush();

    $this->get(route('laporan-bulanan.public'));

    expect(Cache::has('public_laporan_bulanan_all'))->toBeTrue();
});
