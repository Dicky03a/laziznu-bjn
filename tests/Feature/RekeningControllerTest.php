<?php

use App\Models\Rekening;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    $this->seed(Database\Seeders\RoleSeeder::class);
    $this->user = User::factory()->create();
    $this->user->assignRole('super-admin');

    $this->valid = [
        'nama' => 'Bank BNI Syariah',
        'bank_atas_nama' => 'LAZISNU Bojonegoro',
        'nomor_rekening' => '1234567890',
    ];
});

// ── INDEX ─────────────────────────────────────────────────────────────────────

test('it shows the rekening index page', function () {
    $response = $this->actingAs($this->user)->get(route('rekenings.index'));

    $response->assertOk();
    $response->assertViewIs('admin.rekenings.index');
    $response->assertViewHas('rekenings');
});

// ── CREATE ────────────────────────────────────────────────────────────────────

test('it shows the create rekening form', function () {
    $response = $this->actingAs($this->user)->get(route('rekenings.create'));

    $response->assertOk();
    $response->assertViewIs('admin.rekenings.create');
});

// ── STORE VALIDATION ──────────────────────────────────────────────────────────

test('it fails to store without nama', function () {
    $response = $this->actingAs($this->user)
        ->post(route('rekenings.store'), [...$this->valid, 'nama' => '']);

    $response->assertSessionHasErrors('nama');
});

test('it fails to store without bank_atas_nama', function () {
    $response = $this->actingAs($this->user)
        ->post(route('rekenings.store'), [...$this->valid, 'bank_atas_nama' => '']);

    $response->assertSessionHasErrors('bank_atas_nama');
});

test('it fails to store without nomor_rekening', function () {
    $response = $this->actingAs($this->user)
        ->post(route('rekenings.store'), [...$this->valid, 'nomor_rekening' => '']);

    $response->assertSessionHasErrors('nomor_rekening');
});

test('it fails to store with duplicate nama', function () {
    Rekening::create($this->valid);

    $response = $this->actingAs($this->user)
        ->post(route('rekenings.store'), [...$this->valid, 'nomor_rekening' => '9999999999']);

    $response->assertSessionHasErrors('nama');
});

test('it fails to store with duplicate nomor_rekening', function () {
    Rekening::create($this->valid);

    $response = $this->actingAs($this->user)
        ->post(route('rekenings.store'), [...$this->valid, 'nama' => 'Bank Lain']);

    $response->assertSessionHasErrors('nomor_rekening');
});

// ── STORE HAPPY PATH ──────────────────────────────────────────────────────────

test('it stores a rekening without icon', function () {
    $response = $this->actingAs($this->user)
        ->post(route('rekenings.store'), $this->valid);

    $response->assertRedirect(route('rekenings.index'));
    $response->assertSessionHas('success');
    expect(Rekening::where('nama', 'Bank BNI Syariah')->exists())->toBeTrue();
});

test('it stores a rekening with icon', function () {
    Storage::fake('public');

    $response = $this->actingAs($this->user)
        ->post(route('rekenings.store'), [
            ...$this->valid,
            'icon' => UploadedFile::fake()->image('icon.png', 100, 100),
        ]);

    $response->assertRedirect(route('rekenings.index'));
    $rekening = Rekening::where('nama', 'Bank BNI Syariah')->first();
    expect($rekening->icon)->toStartWith('rekenings/');
    Storage::disk('public')->assertExists($rekening->icon);
});

// ── SHOW ──────────────────────────────────────────────────────────────────────

test('it shows the rekening detail page', function () {
    $rekening = Rekening::create($this->valid);

    $response = $this->actingAs($this->user)->get(route('rekenings.show', $rekening));

    $response->assertOk();
    $response->assertViewIs('admin.rekenings.show');
    $response->assertViewHas('rekening', fn ($r) => $r->id === $rekening->id);
});

// ── EDIT ──────────────────────────────────────────────────────────────────────

test('it shows the edit rekening form', function () {
    $rekening = Rekening::create($this->valid);

    $response = $this->actingAs($this->user)->get(route('rekenings.edit', $rekening));

    $response->assertOk();
    $response->assertViewIs('admin.rekenings.edit');
    $response->assertViewHas('rekening', fn ($r) => $r->id === $rekening->id);
});

// ── UPDATE ────────────────────────────────────────────────────────────────────

test('it updates rekening data', function () {
    $rekening = Rekening::create($this->valid);

    $this->actingAs($this->user)
        ->put(route('rekenings.update', $rekening), [
            ...$this->valid,
            'bank_atas_nama' => 'Nama Baru',
        ]);

    expect($rekening->fresh()->bank_atas_nama)->toBe('Nama Baru');
});

test('it can update rekening without changing unique fields (self-ignore)', function () {
    $rekening = Rekening::create($this->valid);

    $response = $this->actingAs($this->user)
        ->put(route('rekenings.update', $rekening), $this->valid);

    $response->assertRedirect(route('rekenings.index'));
    $response->assertSessionHasNoErrors();
});

test('it replaces icon lama when updating with icon baru', function () {
    Storage::fake('public');
    Storage::disk('public')->put('rekenings/lama.png', 'old icon');

    $rekening = Rekening::create([...$this->valid, 'icon' => 'rekenings/lama.png']);

    $this->actingAs($this->user)
        ->put(route('rekenings.update', $rekening), [
            ...$this->valid,
            'icon' => UploadedFile::fake()->image('baru.png', 100, 100),
        ]);

    $rekening->refresh();
    expect($rekening->icon)->not->toBe('rekenings/lama.png');
    Storage::disk('public')->assertMissing('rekenings/lama.png');
    Storage::disk('public')->assertExists($rekening->icon);
});

// ── DESTROY ───────────────────────────────────────────────────────────────────

test('it deletes a rekening (hard delete)', function () {
    $rekening = Rekening::create($this->valid);

    $response = $this->actingAs($this->user)
        ->delete(route('rekenings.destroy', $rekening));

    $response->assertRedirect(route('rekenings.index'));
    $response->assertSessionHas('success');
    expect(Rekening::find($rekening->id))->toBeNull();
});

test('it deletes icon file when destroying rekening', function () {
    Storage::fake('public');
    Storage::disk('public')->put('rekenings/icon.png', 'icon content');

    $rekening = Rekening::create([...$this->valid, 'icon' => 'rekenings/icon.png']);

    $this->actingAs($this->user)->delete(route('rekenings.destroy', $rekening));

    Storage::disk('public')->assertMissing('rekenings/icon.png');
});

// ── CACHE / OBSERVER ──────────────────────────────────────────────────────────

test('it clears cache when rekening is created via controller', function () {
    Cache::put('public_rekenings_all', 'cached', 60);

    $this->actingAs($this->user)->post(route('rekenings.store'), $this->valid);

    expect(Cache::has('public_rekenings_all'))->toBeFalse();
});

test('it clears cache when rekening is updated via controller', function () {
    $rekening = Rekening::create($this->valid);
    Cache::put('public_rekenings_all', 'cached', 60);

    $this->actingAs($this->user)
        ->put(route('rekenings.update', $rekening), [...$this->valid, 'bank_atas_nama' => 'Updated']);

    expect(Cache::has('public_rekenings_all'))->toBeFalse();
});

test('it clears cache when rekening is deleted via controller', function () {
    $rekening = Rekening::create($this->valid);
    Cache::put('public_rekenings_all', 'cached', 60);

    $this->actingAs($this->user)->delete(route('rekenings.destroy', $rekening));

    expect(Cache::has('public_rekenings_all'))->toBeFalse();
});

test('observer clears cache on direct save', function () {
    $rekening = Rekening::create($this->valid);
    Cache::put('public_rekenings_all', 'cached', 60);

    $rekening->bank_atas_nama = 'Diubah Langsung';
    $rekening->save();

    expect(Cache::has('public_rekenings_all'))->toBeFalse();
});

test('observer clears cache on direct delete', function () {
    $rekening = Rekening::create($this->valid);
    Cache::put('public_rekenings_all', 'cached', 60);

    $rekening->delete();

    expect(Cache::has('public_rekenings_all'))->toBeFalse();
});
