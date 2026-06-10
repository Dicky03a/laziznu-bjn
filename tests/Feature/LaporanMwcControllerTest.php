<?php

use App\Models\LaporanMwc;
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
 * Buat record LaporanMwc langsung di DB dengan file palsu di storage.
 * file_laporan menyimpan hanya filename (bukan path lengkap).
 */
function createLaporanMwc(array $attrs = []): LaporanMwc
{
    Storage::disk('public')->put('laporan-mwc/test.pdf', '%PDF-1.4 fake');

    return LaporanMwc::create(array_merge([
        'nama' => 'Laporan MWC Januari 2024',
        'file_laporan' => 'test.pdf',
    ], $attrs));
}

// ── INDEX ─────────────────────────────────────────────────────────────────────

test('it shows the laporan mwc index page', function () {
    $response = $this->actingAs($this->user)->get(route('laporan-mwc.index'));

    $response->assertOk();
    $response->assertViewIs('admin.laporan-mwc.index');
    $response->assertViewHas('laporanMwc');
});

// ── CREATE ────────────────────────────────────────────────────────────────────

test('it shows the create laporan mwc form', function () {
    $response = $this->actingAs($this->user)->get(route('laporan-mwc.create'));

    $response->assertOk();
    $response->assertViewIs('admin.laporan-mwc.create');
});

// ── STORE VALIDATION ──────────────────────────────────────────────────────────

test('it fails to store without nama', function () {
    Storage::fake('public');

    $response = $this->actingAs($this->user)
        ->post(route('laporan-mwc.store'), [
            'nama' => '',
            'file_laporan' => fakePdf(),
        ]);

    $response->assertSessionHasErrors('nama');
});

test('it fails to store without file_laporan', function () {
    $response = $this->actingAs($this->user)
        ->post(route('laporan-mwc.store'), ['nama' => 'Laporan MWC']);

    $response->assertSessionHasErrors('file_laporan');
});

test('it fails to store with non-PDF file', function () {
    Storage::fake('public');

    $response = $this->actingAs($this->user)
        ->post(route('laporan-mwc.store'), [
            'nama' => 'Laporan MWC',
            'file_laporan' => UploadedFile::fake()->image('photo.jpg'),
        ]);

    $response->assertSessionHasErrors('file_laporan');
});

// ── STORE HAPPY PATH ──────────────────────────────────────────────────────────

test('it stores a laporan mwc with PDF file', function () {
    Storage::fake('public');

    $response = $this->actingAs($this->user)
        ->post(route('laporan-mwc.store'), [
            'nama' => 'Laporan MWC Februari 2024',
            'file_laporan' => fakePdf('februari.pdf'),
        ]);

    $response->assertRedirect(route('laporan-mwc.index'));
    $response->assertSessionHas('success');
    expect(LaporanMwc::where('nama', 'Laporan MWC Februari 2024')->exists())->toBeTrue();
});

test('it stores only filename in file_laporan column (not full path)', function () {
    Storage::fake('public');

    $this->actingAs($this->user)
        ->post(route('laporan-mwc.store'), [
            'nama' => 'Laporan MWC Maret',
            'file_laporan' => fakePdf('maret.pdf'),
        ]);

    $laporan = LaporanMwc::where('nama', 'Laporan MWC Maret')->first();
    expect($laporan->file_laporan)->not->toContain('/');
    expect($laporan->file_laporan)->toEndWith('.pdf');
});

test('it saves the PDF file under laporan-mwc directory in public storage', function () {
    Storage::fake('public');

    $this->actingAs($this->user)
        ->post(route('laporan-mwc.store'), [
            'nama' => 'Laporan MWC April',
            'file_laporan' => fakePdf('april.pdf'),
        ]);

    $laporan = LaporanMwc::where('nama', 'Laporan MWC April')->first();
    Storage::disk('public')->assertExists('laporan-mwc/' . $laporan->file_laporan);
});

// ── SHOW ──────────────────────────────────────────────────────────────────────

test('it shows a laporan mwc detail page', function () {
    Storage::fake('public');
    $laporan = createLaporanMwc();

    $response = $this->actingAs($this->user)->get(route('laporan-mwc.show', $laporan));

    $response->assertOk();
    $response->assertViewIs('admin.laporan-mwc.show');
    $response->assertViewHas('laporanMwc', fn ($l) => $l->id === $laporan->id);
});

// ── EDIT ──────────────────────────────────────────────────────────────────────

test('it shows the edit laporan mwc form', function () {
    Storage::fake('public');
    $laporan = createLaporanMwc();

    $response = $this->actingAs($this->user)->get(route('laporan-mwc.edit', $laporan));

    $response->assertOk();
    $response->assertViewIs('admin.laporan-mwc.edit');
    $response->assertViewHas('laporanMwc', fn ($l) => $l->id === $laporan->id);
});

// ── UPDATE ────────────────────────────────────────────────────────────────────

test('it updates nama without replacing file', function () {
    Storage::fake('public');
    $laporan = createLaporanMwc(['nama' => 'Nama Lama']);

    $this->actingAs($this->user)
        ->put(route('laporan-mwc.update', $laporan), ['nama' => 'Nama Baru']);

    expect($laporan->fresh()->nama)->toBe('Nama Baru');
    expect($laporan->fresh()->file_laporan)->toBe('test.pdf');
});

test('it replaces file lama when updating with file baru', function () {
    Storage::fake('public');
    $laporan = createLaporanMwc();
    $fileLama = $laporan->file_laporan;

    $this->actingAs($this->user)
        ->put(route('laporan-mwc.update', $laporan), [
            'nama' => $laporan->nama,
            'file_laporan' => fakePdf('baru.pdf'),
        ]);

    $laporan->refresh();
    expect($laporan->file_laporan)->not->toBe($fileLama);
    Storage::disk('public')->assertMissing('laporan-mwc/' . $fileLama);
    Storage::disk('public')->assertExists('laporan-mwc/' . $laporan->file_laporan);
});

test('it fails to update with non-PDF file', function () {
    Storage::fake('public');
    $laporan = createLaporanMwc();

    $response = $this->actingAs($this->user)
        ->put(route('laporan-mwc.update', $laporan), [
            'nama' => $laporan->nama,
            'file_laporan' => UploadedFile::fake()->image('photo.jpg'),
        ]);

    $response->assertSessionHasErrors('file_laporan');
});

// ── DESTROY ───────────────────────────────────────────────────────────────────

test('it deletes a laporan mwc', function () {
    Storage::fake('public');
    $laporan = createLaporanMwc();

    $response = $this->actingAs($this->user)
        ->delete(route('laporan-mwc.destroy', $laporan));

    $response->assertRedirect(route('laporan-mwc.index'));
    $response->assertSessionHas('success');
    expect(LaporanMwc::find($laporan->id))->toBeNull();
});

test('it deletes file from storage when destroying laporan mwc', function () {
    Storage::fake('public');
    $laporan = createLaporanMwc();

    $this->actingAs($this->user)->delete(route('laporan-mwc.destroy', $laporan));

    Storage::disk('public')->assertMissing('laporan-mwc/test.pdf');
});

// ── CACHE / OBSERVER ──────────────────────────────────────────────────────────

test('it clears cache when laporan mwc is created via controller', function () {
    Storage::fake('public');
    Cache::put('public_laporan_mwc_all', 'cached', 60);

    $this->actingAs($this->user)
        ->post(route('laporan-mwc.store'), [
            'nama' => 'Laporan MWC Baru',
            'file_laporan' => fakePdf(),
        ]);

    expect(Cache::has('public_laporan_mwc_all'))->toBeFalse();
});

test('it clears cache when laporan mwc is updated via controller', function () {
    Storage::fake('public');
    $laporan = createLaporanMwc();
    Cache::put('public_laporan_mwc_all', 'cached', 60);

    $this->actingAs($this->user)
        ->put(route('laporan-mwc.update', $laporan), ['nama' => 'Updated']);

    expect(Cache::has('public_laporan_mwc_all'))->toBeFalse();
});

test('it clears cache when laporan mwc is deleted via controller', function () {
    Storage::fake('public');
    $laporan = createLaporanMwc();
    Cache::put('public_laporan_mwc_all', 'cached', 60);

    $this->actingAs($this->user)->delete(route('laporan-mwc.destroy', $laporan));

    expect(Cache::has('public_laporan_mwc_all'))->toBeFalse();
});

test('observer clears cache on direct save', function () {
    Storage::fake('public');
    $laporan = createLaporanMwc();
    Cache::put('public_laporan_mwc_all', 'cached', 60);

    $laporan->nama = 'Diubah Langsung';
    $laporan->save();

    expect(Cache::has('public_laporan_mwc_all'))->toBeFalse();
});

test('observer clears cache on direct delete', function () {
    Storage::fake('public');
    $laporan = createLaporanMwc();
    Cache::put('public_laporan_mwc_all', 'cached', 60);

    $laporan->delete();

    expect(Cache::has('public_laporan_mwc_all'))->toBeFalse();
});

// ── PUBLIC PAGE ───────────────────────────────────────────────────────────────

test('public status mwc ranting page is accessible', function () {
    $response = $this->get(route('status-mwc-ranting'));

    $response->assertOk();
    $response->assertViewIs('pages.public.laporan.statusmwcranting');
    $response->assertViewHas('laporanMwc');
});

test('public page passes all laporan mwc to the view', function () {
    Storage::fake('public');
    createLaporanMwc(['nama' => 'MWC Ranting A']);
    createLaporanMwc(['nama' => 'MWC Ranting B']);

    $response = $this->get(route('status-mwc-ranting'));

    $response->assertViewHas('laporanMwc', fn ($list) => $list->count() === 2);
});

test('public page caches laporan mwc after first request', function () {
    Cache::flush();

    $this->get(route('status-mwc-ranting'));

    expect(Cache::has('public_laporan_mwc_all'))->toBeTrue();
});
