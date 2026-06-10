<?php

use App\Models\Dokuemen;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    $this->seed(Database\Seeders\RoleSeeder::class);
    $this->user = User::factory()->create();
    $this->user->assignRole('super-admin');
});

/** Helper: buat record Dokuemen langsung di DB dengan file palsu di storage. */
function createDokumen(array $attrs = []): Dokuemen
{
    Storage::disk('public')->put('dokumens/test.pdf', '%PDF-1.4 fake');

    return Dokuemen::create(array_merge([
        'nama_dokumen' => 'Laporan Tahunan',
        'file' => 'dokumens/test.pdf',
        'ukuran_file' => 1024,
        'jumlah_download' => 0,
    ], $attrs));
}

// ── INDEX ─────────────────────────────────────────────────────────────────────

test('it shows the dokumen index page', function () {
    $response = $this->actingAs($this->user)->get(route('dokumens.index'));

    $response->assertOk();
    $response->assertViewIs('admin.dokumens.index');
    $response->assertViewHas('dokumens');
});

// ── CREATE ────────────────────────────────────────────────────────────────────

test('it shows the create dokumen form', function () {
    $response = $this->actingAs($this->user)->get(route('dokumens.create'));

    $response->assertOk();
    $response->assertViewIs('admin.dokumens.create');
});

// ── STORE VALIDATION ──────────────────────────────────────────────────────────

test('it fails to store without nama_dokumen', function () {
    Storage::fake('public');

    $response = $this->actingAs($this->user)
        ->post(route('dokumens.store'), [
            'nama_dokumen' => '',
            'file' => UploadedFile::fake()->createWithContent('doc.txt', 'hello'),
        ]);

    $response->assertSessionHasErrors('nama_dokumen');
});

test('it fails to store without file', function () {
    $response = $this->actingAs($this->user)
        ->post(route('dokumens.store'), ['nama_dokumen' => 'Laporan']);

    $response->assertSessionHasErrors('file');
});

test('it fails to store with invalid file type', function () {
    Storage::fake('public');

    $response = $this->actingAs($this->user)
        ->post(route('dokumens.store'), [
            'nama_dokumen' => 'Laporan',
            'file' => UploadedFile::fake()->image('foto.jpg'), // gambar bukan dokumen
        ]);

    $response->assertSessionHasErrors('file');
});

// ── STORE HAPPY PATH ──────────────────────────────────────────────────────────

test('it stores a dokumen with a txt file', function () {
    Storage::fake('public');

    $response = $this->actingAs($this->user)
        ->post(route('dokumens.store'), [
            'nama_dokumen' => 'Panduan Zakat',
            'file' => UploadedFile::fake()->createWithContent('panduan.txt', 'isi panduan zakat'),
        ]);

    $response->assertRedirect(route('dokumens.index'));
    $response->assertSessionHas('success');

    $dokumen = Dokuemen::where('nama_dokumen', 'Panduan Zakat')->first();
    expect($dokumen)->not->toBeNull();
    expect($dokumen->file)->toStartWith('dokumens/');
    Storage::disk('public')->assertExists($dokumen->file);
});

test('it sets jumlah_download to 0 when storing', function () {
    Storage::fake('public');

    $this->actingAs($this->user)
        ->post(route('dokumens.store'), [
            'nama_dokumen' => 'Laporan',
            'file' => UploadedFile::fake()->createWithContent('laporan.txt', 'isi laporan'),
        ]);

    expect(Dokuemen::where('nama_dokumen', 'Laporan')->first()->jumlah_download)->toBe(0);
});

test('it records ukuran_file from uploaded file size', function () {
    Storage::fake('public');
    $content = str_repeat('a', 500);

    $this->actingAs($this->user)
        ->post(route('dokumens.store'), [
            'nama_dokumen' => 'Laporan Ukuran',
            'file' => UploadedFile::fake()->createWithContent('laporan.txt', $content),
        ]);

    $dokumen = Dokuemen::where('nama_dokumen', 'Laporan Ukuran')->first();
    expect($dokumen->ukuran_file)->toBeGreaterThan(0);
});

// ── SHOW ──────────────────────────────────────────────────────────────────────

test('it shows a dokumen detail page', function () {
    Storage::fake('public');
    $dokumen = createDokumen();

    $response = $this->actingAs($this->user)->get(route('dokumens.show', $dokumen));

    $response->assertOk();
    $response->assertViewIs('admin.dokumens.show');
    $response->assertViewHas('dokumen', fn ($d) => $d->id === $dokumen->id);
});

// ── EDIT ──────────────────────────────────────────────────────────────────────

test('it shows the edit dokumen form', function () {
    Storage::fake('public');
    $dokumen = createDokumen();

    $response = $this->actingAs($this->user)->get(route('dokumens.edit', $dokumen));

    $response->assertOk();
    $response->assertViewIs('admin.dokumens.edit');
    $response->assertViewHas('dokumen', fn ($d) => $d->id === $dokumen->id);
});

// ── UPDATE ────────────────────────────────────────────────────────────────────

test('it updates nama_dokumen without replacing file', function () {
    Storage::fake('public');
    $dokumen = createDokumen(['nama_dokumen' => 'Nama Lama']);

    $this->actingAs($this->user)
        ->put(route('dokumens.update', $dokumen), [
            'nama_dokumen' => 'Nama Baru',
        ]);

    expect($dokumen->fresh()->nama_dokumen)->toBe('Nama Baru');
    expect($dokumen->fresh()->file)->toBe('dokumens/test.pdf'); // file tidak berubah
});

test('it replaces file lama when updating with file baru', function () {
    Storage::fake('public');
    $dokumen = createDokumen();
    $fileLama = $dokumen->file;

    $this->actingAs($this->user)
        ->put(route('dokumens.update', $dokumen), [
            'nama_dokumen' => 'Laporan Tahunan',
            'file' => UploadedFile::fake()->createWithContent('baru.txt', 'konten baru'),
        ]);

    $dokumen->refresh();
    expect($dokumen->file)->not->toBe($fileLama);
    Storage::disk('public')->assertMissing($fileLama);
    Storage::disk('public')->assertExists($dokumen->file);
});

test('it updates ukuran_file when replacing file', function () {
    Storage::fake('public');
    $dokumen = createDokumen(['ukuran_file' => 1024]);

    $this->actingAs($this->user)
        ->put(route('dokumens.update', $dokumen), [
            'nama_dokumen' => 'Laporan',
            'file' => UploadedFile::fake()->createWithContent('baru.txt', str_repeat('b', 200)),
        ]);

    expect($dokumen->fresh()->ukuran_file)->not->toBe(1024);
});

// ── DESTROY ───────────────────────────────────────────────────────────────────

test('it deletes a dokumen and removes file from storage', function () {
    Storage::fake('public');
    $dokumen = createDokumen();

    $response = $this->actingAs($this->user)
        ->delete(route('dokumens.destroy', $dokumen));

    $response->assertRedirect(route('dokumens.index'));
    $response->assertSessionHas('success');
    expect(Dokuemen::find($dokumen->id))->toBeNull();
    Storage::disk('public')->assertMissing('dokumens/test.pdf');
});

// ── DOWNLOAD ─────────────────────────────────────────────────────────────────

test('it increments jumlah_download when downloading', function () {
    Storage::fake('public');
    $dokumen = createDokumen(['jumlah_download' => 5]);

    $this->get(route('dokumens.download', $dokumen));

    expect($dokumen->fresh()->jumlah_download)->toBe(6);
});

test('it returns a file download response', function () {
    Storage::fake('public');
    $dokumen = createDokumen(['nama_dokumen' => 'Laporan Tahunan']);

    $response = $this->get(route('dokumens.download', $dokumen));

    $response->assertDownload('Laporan Tahunan.pdf');
});

// ── CACHE / OBSERVER ──────────────────────────────────────────────────────────

test('it clears cache when dokumen is created via controller', function () {
    Storage::fake('public');
    Cache::put('public_dokumens_all', 'cached', 60);

    $this->actingAs($this->user)
        ->post(route('dokumens.store'), [
            'nama_dokumen' => 'Laporan Baru',
            'file' => UploadedFile::fake()->createWithContent('laporan.txt', 'isi'),
        ]);

    expect(Cache::has('public_dokumens_all'))->toBeFalse();
});

test('it clears cache when dokumen is updated via controller', function () {
    Storage::fake('public');
    $dokumen = createDokumen();
    Cache::put('public_dokumens_all', 'cached', 60);

    $this->actingAs($this->user)
        ->put(route('dokumens.update', $dokumen), ['nama_dokumen' => 'Updated']);

    expect(Cache::has('public_dokumens_all'))->toBeFalse();
});

test('it clears cache when dokumen is deleted via controller', function () {
    Storage::fake('public');
    $dokumen = createDokumen();
    Cache::put('public_dokumens_all', 'cached', 60);

    $this->actingAs($this->user)->delete(route('dokumens.destroy', $dokumen));

    expect(Cache::has('public_dokumens_all'))->toBeFalse();
});

test('observer clears cache on direct save', function () {
    Storage::fake('public');
    $dokumen = createDokumen();
    Cache::put('public_dokumens_all', 'cached', 60);

    $dokumen->nama_dokumen = 'Diubah Langsung';
    $dokumen->save();

    expect(Cache::has('public_dokumens_all'))->toBeFalse();
});

test('observer clears cache on direct delete', function () {
    Storage::fake('public');
    $dokumen = createDokumen();
    Cache::put('public_dokumens_all', 'cached', 60);

    $dokumen->delete();

    expect(Cache::has('public_dokumens_all'))->toBeFalse();
});
