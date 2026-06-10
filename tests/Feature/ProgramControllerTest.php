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

    $this->valid = [
        'type' => 'donasi',
        'nama' => 'Program Donasi Test',
        'deskripsi' => 'Deskripsi program donasi test',
    ];
});

function createProgram(array $attrs = []): Program
{
    return Program::create(array_merge([
        'type' => 'donasi',
        'nama' => 'Program Test',
        'slug' => 'program-test-'.uniqid(),
        'deskripsi' => 'Deskripsi program',
        'is_active' => true,
        'is_featured' => false,
    ], $attrs));
}

// ── INDEX ─────────────────────────────────────────────────────────────────────

test('it shows the program index page', function () {
    $response = $this->actingAs($this->user)->get(route('programs.index'));

    $response->assertOk();
    $response->assertViewIs('admin.programs.index');
    $response->assertViewHas('programs');
});

test('it filters programs by type', function () {
    createProgram(['type' => 'zakat', 'nama' => 'Program Zakat']);
    createProgram(['type' => 'donasi', 'nama' => 'Program Donasi']);

    $response = $this->actingAs($this->user)
        ->get(route('programs.index', ['type' => 'zakat']));

    $response->assertOk();
    $response->assertViewHas('programs', fn ($p) => $p->contains('nama', 'Program Zakat'));
});

test('it filters programs by search', function () {
    createProgram(['nama' => 'Program Beasiswa Yatim']);
    createProgram(['nama' => 'Program Sembako']);

    $response = $this->actingAs($this->user)
        ->get(route('programs.index', ['search' => 'Beasiswa']));

    $response->assertOk();
    $response->assertViewHas('programs', fn ($p) => $p->contains('nama', 'Program Beasiswa Yatim'));
});

// ── CREATE ────────────────────────────────────────────────────────────────────

test('it shows the create program form', function () {
    $response = $this->actingAs($this->user)->get(route('programs.create'));

    $response->assertOk();
    $response->assertViewIs('admin.programs.create');
});

// ── STORE VALIDATION ──────────────────────────────────────────────────────────

test('it fails to store without type', function () {
    $response = $this->actingAs($this->user)
        ->post(route('programs.store'), [...$this->valid, 'type' => '']);

    $response->assertSessionHasErrors('type');
});

test('it fails to store with invalid type', function () {
    $response = $this->actingAs($this->user)
        ->post(route('programs.store'), [...$this->valid, 'type' => 'qurban']);

    $response->assertSessionHasErrors('type');
});

test('it fails to store without nama', function () {
    $response = $this->actingAs($this->user)
        ->post(route('programs.store'), [...$this->valid, 'nama' => '']);

    $response->assertSessionHasErrors('nama');
});

test('it fails to store without deskripsi', function () {
    $response = $this->actingAs($this->user)
        ->post(route('programs.store'), [...$this->valid, 'deskripsi' => '']);

    $response->assertSessionHasErrors('deskripsi');
});

test('it fails to store with non-image thumbnail', function () {
    Storage::fake('public');

    $response = $this->actingAs($this->user)
        ->post(route('programs.store'), [
            ...$this->valid,
            'thumbnail' => UploadedFile::fake()->create('doc.pdf', 100, 'application/pdf'),
        ]);

    $response->assertSessionHasErrors('thumbnail');
});

test('it fails to store with negative target_dana', function () {
    $response = $this->actingAs($this->user)
        ->post(route('programs.store'), [...$this->valid, 'target_dana' => -1]);

    $response->assertSessionHasErrors('target_dana');
});

test('it fails to store with end_date before start_date', function () {
    $response = $this->actingAs($this->user)
        ->post(route('programs.store'), [
            ...$this->valid,
            'start_date' => '2025-12-31',
            'end_date' => '2025-01-01',
        ]);

    $response->assertSessionHasErrors('end_date');
});

// ── STORE HAPPY PATH ──────────────────────────────────────────────────────────

test('it stores a program and redirects to index', function () {
    $response = $this->actingAs($this->user)
        ->post(route('programs.store'), $this->valid);

    $response->assertRedirect(route('programs.index'));
    $response->assertSessionHas('success');
    expect(Program::where('nama', 'Program Donasi Test')->exists())->toBeTrue();
});

test('it auto-generates slug from nama', function () {
    $this->actingAs($this->user)
        ->post(route('programs.store'), [...$this->valid, 'nama' => 'Program Beasiswa Santri']);

    $program = Program::where('nama', 'Program Beasiswa Santri')->first();
    expect($program->slug)->not->toBeEmpty();
    expect($program->slug)->toContain('program-beasiswa-santri');
});

test('it stores a program with thumbnail', function () {
    Storage::fake('public');

    $this->actingAs($this->user)
        ->post(route('programs.store'), [
            ...$this->valid,
            'thumbnail' => UploadedFile::fake()->image('thumb.jpg', 400, 300),
        ]);

    $program = Program::where('nama', 'Program Donasi Test')->first();
    expect($program->thumbnail)->toStartWith('programs/thumbnails/');
    Storage::disk('public')->assertExists($program->thumbnail);
});

test('it stores a program with all optional fields', function () {
    $response = $this->actingAs($this->user)
        ->post(route('programs.store'), [
            ...$this->valid,
            'target_dana' => 5000000,
            'is_active' => true,
            'is_featured' => true,
            'start_date' => '2025-01-01',
            'end_date' => '2025-12-31',
        ]);

    $response->assertSessionHasNoErrors();
    $program = Program::where('nama', 'Program Donasi Test')->first();
    expect($program->target_dana)->toBe(5000000);
    expect($program->is_featured)->toBeTrue();
});

// ── EDIT ──────────────────────────────────────────────────────────────────────

test('it shows the edit program form', function () {
    $program = createProgram();

    $response = $this->actingAs($this->user)->get(route('programs.edit', $program));

    $response->assertOk();
    $response->assertViewIs('admin.programs.edit');
    $response->assertViewHas('program', fn ($p) => $p->id === $program->id);
});

// ── UPDATE ────────────────────────────────────────────────────────────────────

test('it updates program data', function () {
    $program = createProgram();

    $this->actingAs($this->user)
        ->put(route('programs.update', $program), [
            ...$this->valid,
            'nama' => 'Program Diperbarui',
        ]);

    expect($program->fresh()->nama)->toBe('Program Diperbarui');
});

test('it replaces thumbnail when updating with new image', function () {
    Storage::fake('public');
    Storage::disk('public')->put('programs/thumbnails/lama.jpg', 'old image');
    $program = createProgram(['thumbnail' => 'programs/thumbnails/lama.jpg']);

    $this->actingAs($this->user)
        ->put(route('programs.update', $program), [
            ...$this->valid,
            'thumbnail' => UploadedFile::fake()->image('baru.jpg', 400, 300),
        ]);

    $program->refresh();
    expect($program->thumbnail)->not->toBe('programs/thumbnails/lama.jpg');
    Storage::disk('public')->assertMissing('programs/thumbnails/lama.jpg');
    Storage::disk('public')->assertExists($program->thumbnail);
});

test('it redirects to programs.index after update', function () {
    $program = createProgram();

    $response = $this->actingAs($this->user)
        ->put(route('programs.update', $program), $this->valid);

    $response->assertRedirect(route('programs.index'));
    $response->assertSessionHas('success');
});

// ── DESTROY ───────────────────────────────────────────────────────────────────

test('it soft deletes a program', function () {
    $program = createProgram();

    $response = $this->actingAs($this->user)
        ->delete(route('programs.destroy', $program));

    $response->assertRedirect(route('programs.index'));
    $response->assertSessionHas('success');
    expect(Program::find($program->id))->toBeNull();
    expect(Program::withTrashed()->find($program->id))->not->toBeNull();
});

test('super-admin can destroy program with distributions', function () {
    $program = createProgram();
    DistributionProgram::create([
        'source_program_id' => $program->id,
        'nama' => 'Distribusi Test',
        'slug' => 'distribusi-test',
        'deskripsi' => 'Deskripsi',
        'target_dana' => 0,
    ]);

    $response = $this->actingAs($this->user)
        ->delete(route('programs.destroy', $program));

    $response->assertRedirect(route('programs.index'));
    $response->assertSessionHas('success');
});

test('non-super-admin cannot destroy program with distributions', function () {
    $admin = User::factory()->create();
    $admin->assignRole('admin');

    $program = createProgram();
    DistributionProgram::create([
        'source_program_id' => $program->id,
        'nama' => 'Distribusi Test',
        'slug' => 'distribusi-test-2',
        'deskripsi' => 'Deskripsi',
        'target_dana' => 0,
    ]);

    $response = $this->actingAs($admin)
        ->delete(route('programs.destroy', $program));

    $response->assertRedirect(route('programs.index'));
    $response->assertSessionHas('error');
    expect(Program::find($program->id))->not->toBeNull();
});

// ── TOGGLE ACTIVE ─────────────────────────────────────────────────────────────

test('it toggles program active status', function () {
    $program = createProgram(['is_active' => true]);

    $this->actingAs($this->user)
        ->patch(route('programs.toggle-active', $program));

    expect($program->fresh()->is_active)->toBeFalse();
});

test('it toggles program from inactive to active', function () {
    $program = createProgram(['is_active' => false]);

    $this->actingAs($this->user)
        ->patch(route('programs.toggle-active', $program));

    expect($program->fresh()->is_active)->toBeTrue();
});

// ── CACHE / OBSERVER ──────────────────────────────────────────────────────────

test('it clears cache when program is created via controller', function () {
    Cache::put('public_programs_latest_3', 'cached', 60);
    Cache::put('public_program_unggulan', 'cached', 60);
    Cache::put('public_programs_donasi', 'cached', 60);

    $this->actingAs($this->user)->post(route('programs.store'), $this->valid);

    expect(Cache::has('public_programs_latest_3'))->toBeFalse();
    expect(Cache::has('public_program_unggulan'))->toBeFalse();
    expect(Cache::has('public_programs_donasi'))->toBeFalse();
});

test('it clears cache when program is updated via controller', function () {
    $program = createProgram();
    Cache::put('public_programs_latest_3', 'cached', 60);

    $this->actingAs($this->user)
        ->put(route('programs.update', $program), [...$this->valid, 'nama' => 'Updated']);

    expect(Cache::has('public_programs_latest_3'))->toBeFalse();
});

test('it clears cache when program is deleted via controller', function () {
    $program = createProgram();
    Cache::put('public_programs_latest_3', 'cached', 60);

    $this->actingAs($this->user)->delete(route('programs.destroy', $program));

    expect(Cache::has('public_programs_latest_3'))->toBeFalse();
});

test('observer clears cache on direct save', function () {
    $program = createProgram();
    Cache::put('public_programs_latest_3', 'cached', 60);
    Cache::put('public_programs_donasi', 'cached', 60);

    $program->nama = 'Diubah Langsung';
    $program->save();

    expect(Cache::has('public_programs_latest_3'))->toBeFalse();
    expect(Cache::has('public_programs_donasi'))->toBeFalse();
});

test('observer clears cache on direct delete', function () {
    $program = createProgram();
    Cache::put('public_program_unggulan', 'cached', 60);

    $program->delete();

    expect(Cache::has('public_program_unggulan'))->toBeFalse();
});
