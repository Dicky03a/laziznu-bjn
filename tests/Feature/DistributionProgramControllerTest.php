<?php

use App\Models\DistributionProgram;
use App\Models\Program;
use App\Models\Transaction;
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
 * Buat Program donasi dengan confirmed transaction sebesar $terkumpul.
 */
function createSourceProg(int $terkumpul = 10_000_000): Program
{
    $program = Program::create([
        'type' => 'donasi',
        'nama' => 'Program Sumber '.uniqid(),
        'slug' => 'program-sumber-'.uniqid(),
        'deskripsi' => 'Deskripsi sumber',
        'is_active' => true,
    ]);

    if ($terkumpul > 0) {
        $confirmer = \App\Models\User::factory()->create();
        Transaction::create([
            'kode_transaksi' => 'INFQ-'.now()->format('Ymd').'-'.strtoupper(bin2hex(random_bytes(3))),
            'type' => 'donasi',
            'program_id' => $program->id,
            'nama_donatur' => 'Donatur Sumber',
            'jumlah' => $terkumpul,
            'status' => Transaction::STATUS_CONFIRMED,
            'confirmed_by' => $confirmer->id,
        ]);
    }

    return $program;
}

function createDist(Program $source, array $attrs = []): DistributionProgram
{
    return DistributionProgram::create(array_merge([
        'source_program_id' => $source->id,
        'nama' => 'Distribusi Test '.uniqid(),
        'slug' => 'distribusi-test-'.uniqid(),
        'deskripsi' => 'Deskripsi distribusi',
        'target_dana' => 1_000_000,
        'is_active' => true,
    ], $attrs));
}

$validData = fn (Program $source) => [
    'source_program_id' => $source->id,
    'nama' => 'Program Distribusi Baru',
    'deskripsi' => 'Deskripsi distribusi',
    'target_dana' => 1_000_000,
];

// ── INDEX ─────────────────────────────────────────────────────────────────────

test('it shows the distribution program index page', function () {
    $response = $this->actingAs($this->user)->get(route('distribution-programs.index'));

    $response->assertOk();
    $response->assertViewIs('admin.distribution-programs.index');
    $response->assertViewHas('distributionPrograms');
});

test('index shows statistics', function () {
    $source = createSourceProg();
    createDist($source);

    $response = $this->actingAs($this->user)->get(route('distribution-programs.index'));

    $response->assertOk();
    $response->assertViewHas('totalTerkumpul');
    $response->assertViewHas('totalDialokasikan');
});

// ── CREATE ────────────────────────────────────────────────────────────────────

test('it shows the create distribution program form', function () {
    $response = $this->actingAs($this->user)->get(route('distribution-programs.create'));

    $response->assertOk();
    $response->assertViewIs('admin.distribution-programs.create');
    $response->assertViewHas('sourcePrograms');
});

// ── STORE VALIDATION ──────────────────────────────────────────────────────────

test('it fails to store without source_program_id', function () {
    $response = $this->actingAs($this->user)
        ->post(route('distribution-programs.store'), [
            'nama' => 'Test', 'deskripsi' => 'Desc', 'target_dana' => 1_000_000,
        ]);

    $response->assertSessionHasErrors('source_program_id');
});

test('it fails to store without nama', function () {
    $source = createSourceProg();

    $response = $this->actingAs($this->user)
        ->post(route('distribution-programs.store'), [
            'source_program_id' => $source->id, 'deskripsi' => 'Desc', 'target_dana' => 1_000_000,
        ]);

    $response->assertSessionHasErrors('nama');
});

test('it fails to store with target_dana below 1000', function () {
    $source = createSourceProg();

    $response = $this->actingAs($this->user)
        ->post(route('distribution-programs.store'), [
            'source_program_id' => $source->id,
            'nama' => 'Test', 'deskripsi' => 'Desc', 'target_dana' => 500,
        ]);

    $response->assertSessionHasErrors('target_dana');
});

// ── STORE HAPPY PATH ──────────────────────────────────────────────────────────

test('it stores a distribution program when funds are sufficient', function () {
    $source = createSourceProg(10_000_000);
    $data = [
        'source_program_id' => $source->id,
        'nama' => 'Program Distribusi Baru',
        'deskripsi' => 'Deskripsi',
        'target_dana' => 1_000_000,
    ];

    $response = $this->actingAs($this->user)
        ->post(route('distribution-programs.store'), $data);

    $response->assertRedirect(route('distribution-programs.index'));
    $response->assertSessionHas('success');
    expect(DistributionProgram::where('nama', 'Program Distribusi Baru')->exists())->toBeTrue();
});

test('it auto-generates slug when storing', function () {
    $source = createSourceProg();

    $this->actingAs($this->user)
        ->post(route('distribution-programs.store'), [
            'source_program_id' => $source->id,
            'nama' => 'Beasiswa Santri Berprestasi',
            'deskripsi' => 'Desc', 'target_dana' => 1_000_000,
        ]);

    $dist = DistributionProgram::where('nama', 'Beasiswa Santri Berprestasi')->first();
    expect($dist->slug)->not->toBeEmpty();
    expect($dist->slug)->toContain('beasiswa-santri-berprestasi');
});

test('it shows validation error when target_dana exceeds available funds', function () {
    $source = createSourceProg(1_000_000);

    $response = $this->actingAs($this->user)
        ->post(route('distribution-programs.store'), [
            'source_program_id' => $source->id,
            'nama' => 'Distribusi Berlebih',
            'deskripsi' => 'Desc',
            'target_dana' => 5_000_000,
        ]);

    $response->assertRedirect();
    $response->assertSessionHasErrors('target_dana');
});

test('it stores distribution with thumbnail', function () {
    Storage::fake('public');
    $source = createSourceProg();

    $this->actingAs($this->user)
        ->post(route('distribution-programs.store'), [
            'source_program_id' => $source->id,
            'nama' => 'Distribusi Thumb',
            'deskripsi' => 'Desc',
            'target_dana' => 1_000_000,
            'thumbnail' => UploadedFile::fake()->image('thumb.jpg', 400, 300),
        ]);

    $dist = DistributionProgram::where('nama', 'Distribusi Thumb')->first();
    expect($dist->thumbnail)->toStartWith('distribution-programs/thumbnails/');
    Storage::disk('public')->assertExists($dist->thumbnail);
});

// ── EDIT ──────────────────────────────────────────────────────────────────────

test('it shows the edit distribution program form', function () {
    $source = createSourceProg();
    $dist = createDist($source);

    $response = $this->actingAs($this->user)
        ->get(route('distribution-programs.edit', $dist));

    $response->assertOk();
    $response->assertViewIs('admin.distribution-programs.edit');
    $response->assertViewHas('distributionProgram', fn ($d) => $d->id === $dist->id);
});

// ── UPDATE ────────────────────────────────────────────────────────────────────

test('it updates distribution program nama', function () {
    $source = createSourceProg();
    $dist = createDist($source, ['target_dana' => 1_000_000]);

    $this->actingAs($this->user)
        ->put(route('distribution-programs.update', $dist), [
            'source_program_id' => $source->id,
            'nama' => 'Nama Diperbarui',
            'deskripsi' => 'Desc',
            'target_dana' => 1_000_000,
        ]);

    expect($dist->fresh()->nama)->toBe('Nama Diperbarui');
});

test('update self-ignore does not abort when target_dana unchanged', function () {
    $source = createSourceProg(5_000_000);
    $dist = createDist($source, ['target_dana' => 4_000_000]);

    $response = $this->actingAs($this->user)
        ->put(route('distribution-programs.update', $dist), [
            'source_program_id' => $source->id,
            'nama' => $dist->nama,
            'deskripsi' => 'Desc',
            'target_dana' => 4_000_000,
        ]);

    $response->assertRedirect(route('distribution-programs.index'));
    $response->assertSessionHas('success');
});

test('it replaces thumbnail when updating', function () {
    Storage::fake('public');
    Storage::disk('public')->put('distribution-programs/thumbnails/lama.jpg', 'old');
    $source = createSourceProg();
    $dist = createDist($source, ['thumbnail' => 'distribution-programs/thumbnails/lama.jpg']);

    $this->actingAs($this->user)
        ->put(route('distribution-programs.update', $dist), [
            'source_program_id' => $source->id,
            'nama' => $dist->nama,
            'deskripsi' => 'Desc',
            'target_dana' => 1_000_000,
            'thumbnail' => UploadedFile::fake()->image('baru.jpg', 400, 300),
        ]);

    $dist->refresh();
    Storage::disk('public')->assertMissing('distribution-programs/thumbnails/lama.jpg');
    Storage::disk('public')->assertExists($dist->thumbnail);
});

// ── DESTROY ───────────────────────────────────────────────────────────────────

test('it soft deletes a distribution program', function () {
    $source = createSourceProg();
    $dist = createDist($source);

    $response = $this->actingAs($this->user)
        ->delete(route('distribution-programs.destroy', $dist));

    $response->assertRedirect(route('distribution-programs.index'));
    $response->assertSessionHas('success');
    expect(DistributionProgram::find($dist->id))->toBeNull();
    expect(DistributionProgram::withTrashed()->find($dist->id))->not->toBeNull();
});

test('it deletes thumbnail file when destroying', function () {
    Storage::fake('public');
    Storage::disk('public')->put('distribution-programs/thumbnails/hapus.jpg', 'content');
    $source = createSourceProg();
    $dist = createDist($source, ['thumbnail' => 'distribution-programs/thumbnails/hapus.jpg']);

    $this->actingAs($this->user)->delete(route('distribution-programs.destroy', $dist));

    Storage::disk('public')->assertMissing('distribution-programs/thumbnails/hapus.jpg');
});

// ── TOGGLE ACTIVE ─────────────────────────────────────────────────────────────

test('it toggles distribution program active status', function () {
    $source = createSourceProg();
    $dist = createDist($source, ['is_active' => true]);

    $this->actingAs($this->user)
        ->patch(route('distribution-programs.toggle-active', $dist));

    expect($dist->fresh()->is_active)->toBeFalse();
});

// ── CACHE / OBSERVER ──────────────────────────────────────────────────────────

test('it clears cache when distribution program is created', function () {
    Cache::put('public_distribution_programs_active', 'cached', 60);
    $source = createSourceProg();

    $this->actingAs($this->user)
        ->post(route('distribution-programs.store'), [
            'source_program_id' => $source->id,
            'nama' => 'Distribusi Cache',
            'deskripsi' => 'Desc',
            'target_dana' => 1_000_000,
        ]);

    expect(Cache::has('public_distribution_programs_active'))->toBeFalse();
});

test('it clears cache when distribution program is updated', function () {
    $source = createSourceProg();
    $dist = createDist($source);
    Cache::put('public_distribution_programs_active', 'cached', 60);

    $this->actingAs($this->user)
        ->put(route('distribution-programs.update', $dist), [
            'source_program_id' => $source->id,
            'nama' => 'Updated',
            'deskripsi' => 'Desc',
            'target_dana' => 1_000_000,
        ]);

    expect(Cache::has('public_distribution_programs_active'))->toBeFalse();
});

test('it clears cache when distribution program is deleted', function () {
    $source = createSourceProg();
    $dist = createDist($source);
    Cache::put('public_distribution_programs_active', 'cached', 60);

    $this->actingAs($this->user)->delete(route('distribution-programs.destroy', $dist));

    expect(Cache::has('public_distribution_programs_active'))->toBeFalse();
});

test('observer clears cache on direct save', function () {
    $source = createSourceProg();
    $dist = createDist($source);
    Cache::put('public_distribution_programs_active', 'cached', 60);

    $dist->nama = 'Diubah Langsung';
    $dist->save();

    expect(Cache::has('public_distribution_programs_active'))->toBeFalse();
});

test('observer clears cache on direct delete', function () {
    $source = createSourceProg();
    $dist = createDist($source);
    Cache::put('public_distribution_programs_active', 'cached', 60);

    $dist->delete();

    expect(Cache::has('public_distribution_programs_active'))->toBeFalse();
});
