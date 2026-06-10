<?php

use App\Models\Pengurus;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    $this->seed(Database\Seeders\RoleSeeder::class);
    $this->user = User::factory()->create();
    $this->user->assignRole('super-admin');

    $this->valid = [
        'nama' => 'Ahmad Fulan',
        'jabatan' => 'Ketua',
        'urutan' => 1,
        'masa_khidmat_mulai' => 2024,
        'masa_khidmat_selesai' => 2027,
    ];
});

// ── INDEX ─────────────────────────────────────────────────────────────────────

test('it shows the pengurus index page', function () {
    $response = $this->actingAs($this->user)->get(route('pengurus.index'));

    $response->assertOk();
    $response->assertViewIs('admin.pengurus.index');
    $response->assertViewHas(['pengurusList', 'jabatanList', 'periodeList']);
});

test('it filters pengurus by search keyword', function () {
    Pengurus::create([...$this->valid, 'nama' => 'Budi Santoso']);
    Pengurus::create([...$this->valid, 'nama' => 'Siti Aminah', 'jabatan' => 'Sekretaris']);

    $response = $this->actingAs($this->user)
        ->get(route('pengurus.index', ['search' => 'Budi']));

    $response->assertViewHas('pengurusList', fn ($list) =>
        $list->total() === 1 && $list->first()->nama === 'Budi Santoso'
    );
});

test('it filters pengurus by is_active status', function () {
    Pengurus::create([...$this->valid, 'is_active' => true]);
    Pengurus::create([...$this->valid, 'nama' => 'Nonaktif', 'jabatan' => 'Sekretaris', 'is_active' => false]);

    $response = $this->actingAs($this->user)
        ->get(route('pengurus.index', ['is_active' => '0']));

    $response->assertViewHas('pengurusList', fn ($list) =>
        $list->total() === 1 && $list->first()->nama === 'Nonaktif'
    );
});

// ── CREATE ────────────────────────────────────────────────────────────────────

test('it shows the create pengurus form', function () {
    $response = $this->actingAs($this->user)->get(route('pengurus.create'));

    $response->assertOk();
    $response->assertViewIs('admin.pengurus.create');
    $response->assertViewHas(['jabatanList', 'bidangList']);
});

// ── STORE VALIDATION ──────────────────────────────────────────────────────────

test('it fails to store without nama', function () {
    $response = $this->actingAs($this->user)
        ->post(route('pengurus.store'), [...$this->valid, 'nama' => '']);

    $response->assertSessionHasErrors('nama');
});

test('it fails to store without jabatan', function () {
    $response = $this->actingAs($this->user)
        ->post(route('pengurus.store'), [...$this->valid, 'jabatan' => '']);

    $response->assertSessionHasErrors('jabatan');
});

test('it fails to store with invalid jabatan', function () {
    $response = $this->actingAs($this->user)
        ->post(route('pengurus.store'), [...$this->valid, 'jabatan' => 'Presiden']);

    $response->assertSessionHasErrors('jabatan');
});

test('it fails to store when anggota has no bidang', function () {
    $response = $this->actingAs($this->user)
        ->post(route('pengurus.store'), [...$this->valid, 'jabatan' => 'Anggota']);

    $response->assertSessionHasErrors('bidang');
});

test('it fails to store when anggota has invalid bidang', function () {
    $response = $this->actingAs($this->user)
        ->post(route('pengurus.store'), [...$this->valid, 'jabatan' => 'Anggota', 'bidang' => 'Bidang Fiktif']);

    $response->assertSessionHasErrors('bidang');
});

test('it fails to store when masa_khidmat_selesai is before masa_khidmat_mulai', function () {
    $response = $this->actingAs($this->user)
        ->post(route('pengurus.store'), [
            ...$this->valid,
            'masa_khidmat_mulai' => 2027,
            'masa_khidmat_selesai' => 2024,
        ]);

    $response->assertSessionHasErrors('masa_khidmat_selesai');
});

test('it fails to store with invalid email format', function () {
    $response = $this->actingAs($this->user)
        ->post(route('pengurus.store'), [...$this->valid, 'email' => 'bukan-email']);

    $response->assertSessionHasErrors('email');
});

// ── STORE HAPPY PATH ──────────────────────────────────────────────────────────

test('it stores a pengurus without foto', function () {
    $response = $this->actingAs($this->user)
        ->post(route('pengurus.store'), $this->valid);

    $response->assertRedirect(route('pengurus.index'));
    $response->assertSessionHas('success');
    expect(Pengurus::where('nama', 'Ahmad Fulan')->exists())->toBeTrue();
});

test('it stores a pengurus as anggota with bidang', function () {
    $this->actingAs($this->user)
        ->post(route('pengurus.store'), [
            ...$this->valid,
            'jabatan' => 'Anggota',
            'bidang' => 'IT dan Marcom',
        ]);

    $pengurus = Pengurus::where('nama', 'Ahmad Fulan')->first();
    expect($pengurus->jabatan)->toBe('Anggota');
    expect($pengurus->bidang)->toBe('IT dan Marcom');
});

test('it stores a pengurus with is_active defaulting to true', function () {
    $this->actingAs($this->user)
        ->post(route('pengurus.store'), $this->valid);

    expect(Pengurus::where('nama', 'Ahmad Fulan')->first()->is_active)->toBeTrue();
});

test('it stores a pengurus with foto', function () {
    Storage::fake('public');

    $this->actingAs($this->user)
        ->post(route('pengurus.store'), [
            ...$this->valid,
            'foto' => UploadedFile::fake()->image('foto.jpg', 200, 200),
        ]);

    $pengurus = Pengurus::where('nama', 'Ahmad Fulan')->first();
    expect($pengurus->foto)->toStartWith('pengurus/foto/');
    Storage::disk('public')->assertExists($pengurus->foto);
});

// ── SHOW ──────────────────────────────────────────────────────────────────────

test('it shows a pengurus detail page', function () {
    $pengurus = Pengurus::create($this->valid);

    $response = $this->actingAs($this->user)->get(route('pengurus.show', $pengurus));

    $response->assertOk();
    $response->assertViewIs('admin.pengurus.show');
    $response->assertViewHas('pengurus', fn ($p) => $p->id === $pengurus->id);
});

// ── EDIT ──────────────────────────────────────────────────────────────────────

test('it shows the edit pengurus form with existing data', function () {
    $pengurus = Pengurus::create($this->valid);

    $response = $this->actingAs($this->user)->get(route('pengurus.edit', $pengurus));

    $response->assertOk();
    $response->assertViewIs('admin.pengurus.edit');
    $response->assertViewHas(['pengurus', 'jabatanList', 'bidangList']);
});

// ── UPDATE ────────────────────────────────────────────────────────────────────

test('it updates pengurus data', function () {
    $pengurus = Pengurus::create($this->valid);

    $this->actingAs($this->user)
        ->put(route('pengurus.update', $pengurus), [...$this->valid, 'nama' => 'Nama Baru']);

    expect($pengurus->fresh()->nama)->toBe('Nama Baru');
});

test('it replaces foto lama when updating with foto baru', function () {
    Storage::fake('public');
    Storage::disk('public')->put('pengurus/foto/lama.jpg', 'old image');

    $pengurus = Pengurus::create([...$this->valid, 'foto' => 'pengurus/foto/lama.jpg']);

    $this->actingAs($this->user)
        ->put(route('pengurus.update', $pengurus), [
            ...$this->valid,
            'foto' => UploadedFile::fake()->image('baru.jpg', 200, 200),
        ]);

    $pengurus->refresh();
    expect($pengurus->foto)->not->toBe('pengurus/foto/lama.jpg');
    Storage::disk('public')->assertMissing('pengurus/foto/lama.jpg');
    Storage::disk('public')->assertExists($pengurus->foto);
});

test('it can deactivate a pengurus via update', function () {
    $pengurus = Pengurus::create([...$this->valid, 'is_active' => true]);

    $this->actingAs($this->user)
        ->put(route('pengurus.update', $pengurus), [...$this->valid, 'is_active' => '0']);

    expect($pengurus->fresh()->is_active)->toBeFalse();
});

// ── DESTROY ───────────────────────────────────────────────────────────────────

test('it soft-deletes a pengurus', function () {
    $pengurus = Pengurus::create($this->valid);

    $response = $this->actingAs($this->user)
        ->delete(route('pengurus.destroy', $pengurus));

    $response->assertRedirect(route('pengurus.index'));
    $response->assertSessionHas('success');
    expect(Pengurus::find($pengurus->id))->toBeNull();
    expect(Pengurus::withTrashed()->find($pengurus->id))->not->toBeNull();
});

// ── TOGGLE STATUS ─────────────────────────────────────────────────────────────

test('it toggles active pengurus to inactive', function () {
    $pengurus = Pengurus::create([...$this->valid, 'is_active' => true]);

    $this->actingAs($this->user)
        ->patch(route('pengurus.toggle-status', $pengurus));

    expect($pengurus->fresh()->is_active)->toBeFalse();
});

test('it toggles inactive pengurus to active', function () {
    $pengurus = Pengurus::create([...$this->valid, 'is_active' => false]);

    $this->actingAs($this->user)
        ->patch(route('pengurus.toggle-status', $pengurus));

    expect($pengurus->fresh()->is_active)->toBeTrue();
});

// ── DESTROY FOTO ──────────────────────────────────────────────────────────────

test('it removes foto from a pengurus', function () {
    Storage::fake('public');
    Storage::disk('public')->put('pengurus/foto/test.jpg', 'fake image');

    $pengurus = Pengurus::create([...$this->valid, 'foto' => 'pengurus/foto/test.jpg']);

    $response = $this->actingAs($this->user)
        ->delete(route('pengurus.destroy-foto', $pengurus));

    $response->assertRedirect();
    $response->assertSessionHas('success', 'Foto berhasil dihapus.');
    expect($pengurus->fresh()->foto)->toBeNull();
    Storage::disk('public')->assertMissing('pengurus/foto/test.jpg');
});

test('it handles destroy-foto gracefully when pengurus has no foto', function () {
    $pengurus = Pengurus::create($this->valid); // tidak ada foto

    $response = $this->actingAs($this->user)
        ->delete(route('pengurus.destroy-foto', $pengurus));

    $response->assertRedirect();
    $response->assertSessionHas('success', 'Foto berhasil dihapus.');
});

// ── CACHE / OBSERVER ──────────────────────────────────────────────────────────

test('it clears all cache keys when pengurus is created via controller', function () {
    Cache::put('public_pengurus_periode_aktif', 'cached', 60);
    Cache::put('public_pengurus_by_jabatan', 'cached', 60);
    Cache::put('public_pengurus_no_sk', 'cached', 60);

    $this->actingAs($this->user)->post(route('pengurus.store'), $this->valid);

    expect(Cache::has('public_pengurus_periode_aktif'))->toBeFalse();
    expect(Cache::has('public_pengurus_by_jabatan'))->toBeFalse();
    expect(Cache::has('public_pengurus_no_sk'))->toBeFalse();
});

test('it clears all cache keys when pengurus is updated via controller', function () {
    $pengurus = Pengurus::create($this->valid);
    Cache::put('public_pengurus_periode_aktif', 'cached', 60);
    Cache::put('public_pengurus_by_jabatan', 'cached', 60);
    Cache::put('public_pengurus_no_sk', 'cached', 60);

    $this->actingAs($this->user)
        ->put(route('pengurus.update', $pengurus), [...$this->valid, 'nama' => 'Updated']);

    expect(Cache::has('public_pengurus_periode_aktif'))->toBeFalse();
    expect(Cache::has('public_pengurus_by_jabatan'))->toBeFalse();
    expect(Cache::has('public_pengurus_no_sk'))->toBeFalse();
});

test('it clears all cache keys when pengurus is deleted via controller', function () {
    $pengurus = Pengurus::create($this->valid);
    Cache::put('public_pengurus_periode_aktif', 'cached', 60);
    Cache::put('public_pengurus_by_jabatan', 'cached', 60);
    Cache::put('public_pengurus_no_sk', 'cached', 60);

    $this->actingAs($this->user)
        ->delete(route('pengurus.destroy', $pengurus));

    expect(Cache::has('public_pengurus_periode_aktif'))->toBeFalse();
    expect(Cache::has('public_pengurus_by_jabatan'))->toBeFalse();
    expect(Cache::has('public_pengurus_no_sk'))->toBeFalse();
});

// ── MODEL ACCESSORS & SCOPES ──────────────────────────────────────────────────

test('nama_lengkap includes gelar depan and gelar belakang', function () {
    $pengurus = Pengurus::create([
        ...$this->valid,
        'gelar_depan' => 'Dr.',
        'gelar_belakang' => 'M.Pd.',
    ]);

    expect($pengurus->nama_lengkap)->toBe('Dr. Ahmad Fulan M.Pd.');
});

test('nama_lengkap returns only nama when gelar is null', function () {
    $pengurus = Pengurus::create($this->valid);
    expect($pengurus->nama_lengkap)->toBe('Ahmad Fulan');
});

test('jabatan_label returns Anggota Bidang X for anggota', function () {
    $pengurus = Pengurus::create([...$this->valid, 'jabatan' => 'Anggota', 'bidang' => 'IT dan Marcom']);
    expect($pengurus->jabatan_label)->toBe('Anggota Bidang IT dan Marcom');
});

test('jabatan_label returns jabatan as-is for non-anggota', function () {
    $pengurus = Pengurus::create($this->valid); // Ketua
    expect($pengurus->jabatan_label)->toBe('Ketua');
});

test('periode returns formatted year range string', function () {
    $pengurus = Pengurus::create($this->valid); // 2024-2027
    expect($pengurus->periode)->toBe('2024 - 2027');
});

test('scopeActive returns only active pengurus', function () {
    Pengurus::create([...$this->valid, 'is_active' => true]);
    Pengurus::create([...$this->valid, 'nama' => 'Nonaktif', 'jabatan' => 'Sekretaris', 'is_active' => false]);

    expect(Pengurus::active()->count())->toBe(1);
});

test('scopePeriode returns pengurus whose period overlaps a given year', function () {
    Pengurus::create([...$this->valid, 'masa_khidmat_mulai' => 2020, 'masa_khidmat_selesai' => 2024]);
    Pengurus::create([
        ...$this->valid,
        'nama' => 'Periode Lain',
        'jabatan' => 'Sekretaris',
        'masa_khidmat_mulai' => 2025,
        'masa_khidmat_selesai' => 2028,
    ]);

    $result = Pengurus::periode(2022)->get();
    expect($result)->toHaveCount(1);
    expect($result->first()->nama)->toBe('Ahmad Fulan');
});

test('foto_url returns default avatar when no foto is set', function () {
    $pengurus = Pengurus::create($this->valid);
    expect($pengurus->foto_url)->toContain('avatar-default.png');
});
