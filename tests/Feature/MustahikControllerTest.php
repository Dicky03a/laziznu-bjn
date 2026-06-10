<?php

use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\Mustahik;
use App\Models\User;

beforeEach(function () {
    $this->seed(Database\Seeders\RoleSeeder::class);
    $this->user = User::factory()->create();
    $this->user->assignRole('super-admin');

    $this->kec = Kecamatan::create(['nama' => 'Kecamatan Test']);
    $this->desa = Desa::create(['nama' => 'Desa Test', 'kecamatan_id' => $this->kec->id]);
});

function validMustahikData(Kecamatan $kec, Desa $desa): array
{
    static $counter = 0;
    $counter++;

    return [
        'nama' => 'Mustahik Test '.$counter,
        'nik' => str_pad((string) (1234567890123400 + $counter), 16, '0', STR_PAD_LEFT),
        'jenis_kelamin' => 'laki-laki',
        'kecamatan_id' => $kec->id,
        'desa_id' => $desa->id,
        'kategori_asnaf' => 'fakir',
        'status' => 'aktif',
    ];
}

function createMustahik(Kecamatan $kec, Desa $desa, array $attrs = []): Mustahik
{
    return Mustahik::create(array_merge(validMustahikData($kec, $desa), $attrs));
}

// ── INDEX ─────────────────────────────────────────────────────────────────────

test('it shows the mustahik index page', function () {
    $response = $this->actingAs($this->user)->get(route('mustahiks.index'));

    $response->assertOk();
    $response->assertViewIs('admin.mustahiks.index');
    $response->assertViewHas('mustahiks');
});

test('it filters mustahik by kecamatan_id', function () {
    $kec2 = Kecamatan::create(['nama' => 'Kecamatan Lain']);
    $desa2 = Desa::create(['nama' => 'Desa Lain', 'kecamatan_id' => $kec2->id]);
    createMustahik($this->kec, $this->desa);
    createMustahik($kec2, $desa2);

    $response = $this->actingAs($this->user)
        ->get(route('mustahiks.index', ['kecamatan_id' => $this->kec->id]));

    $response->assertViewHas('mustahiks', fn ($m) => $m->every(fn ($mu) => $mu->kecamatan_id === $this->kec->id));
});

test('it filters mustahik by kategori_asnaf', function () {
    createMustahik($this->kec, $this->desa, ['kategori_asnaf' => 'fakir']);
    createMustahik($this->kec, $this->desa, ['kategori_asnaf' => 'miskin']);

    $response = $this->actingAs($this->user)
        ->get(route('mustahiks.index', ['kategori_asnaf' => 'fakir']));

    $response->assertViewHas('mustahiks', fn ($m) => $m->every(fn ($mu) => $mu->kategori_asnaf === 'fakir'));
});

test('it filters mustahik by status', function () {
    createMustahik($this->kec, $this->desa, ['status' => 'aktif']);
    createMustahik($this->kec, $this->desa, ['status' => 'nonaktif']);

    $response = $this->actingAs($this->user)
        ->get(route('mustahiks.index', ['status' => 'nonaktif']));

    $response->assertViewHas('mustahiks', fn ($m) => $m->every(fn ($mu) => $mu->status === 'nonaktif'));
});

test('it searches mustahik by nama', function () {
    createMustahik($this->kec, $this->desa, ['nama' => 'Ahmad Fauzi']);
    createMustahik($this->kec, $this->desa, ['nama' => 'Budi Santoso']);

    $response = $this->actingAs($this->user)
        ->get(route('mustahiks.index', ['search' => 'Ahmad']));

    $response->assertViewHas('mustahiks', fn ($m) => $m->contains('nama', 'Ahmad Fauzi'));
});

// ── CREATE ────────────────────────────────────────────────────────────────────

test('it shows the create mustahik form', function () {
    $response = $this->actingAs($this->user)->get(route('mustahiks.create'));

    $response->assertOk();
    $response->assertViewIs('admin.mustahiks.create');
    $response->assertViewHas('kecamatans');
});

// ── STORE VALIDATION ──────────────────────────────────────────────────────────

test('it fails to store without nama', function () {
    $data = validMustahikData($this->kec, $this->desa);
    $data['nama'] = '';

    $response = $this->actingAs($this->user)
        ->post(route('mustahiks.store'), $data);

    $response->assertSessionHasErrors('nama');
});

test('it fails to store without nik', function () {
    $data = validMustahikData($this->kec, $this->desa);
    $data['nik'] = '';

    $response = $this->actingAs($this->user)
        ->post(route('mustahiks.store'), $data);

    $response->assertSessionHasErrors('nik');
});

test('it fails to store with nik not 16 digits', function () {
    $data = validMustahikData($this->kec, $this->desa);
    $data['nik'] = '123456789';

    $response = $this->actingAs($this->user)
        ->post(route('mustahiks.store'), $data);

    $response->assertSessionHasErrors('nik');
});

test('it fails to store with duplicate nik', function () {
    $existing = createMustahik($this->kec, $this->desa);
    $data = validMustahikData($this->kec, $this->desa);
    $data['nik'] = $existing->nik;

    $response = $this->actingAs($this->user)
        ->post(route('mustahiks.store'), $data);

    $response->assertSessionHasErrors('nik');
});

test('it fails to store with invalid no_hp format', function () {
    $data = validMustahikData($this->kec, $this->desa);
    $data['no_hp'] = '1234567890';

    $response = $this->actingAs($this->user)
        ->post(route('mustahiks.store'), $data);

    $response->assertSessionHasErrors('no_hp');
});

test('it accepts valid +62 no_hp format', function () {
    $data = validMustahikData($this->kec, $this->desa);
    $data['no_hp'] = '+6281234567890';

    $response = $this->actingAs($this->user)
        ->post(route('mustahiks.store'), $data);

    $response->assertSessionHasNoErrors();
});

test('it accepts valid 08xx no_hp format', function () {
    $data = validMustahikData($this->kec, $this->desa);
    $data['no_hp'] = '081234567890';

    $response = $this->actingAs($this->user)
        ->post(route('mustahiks.store'), $data);

    $response->assertSessionHasNoErrors();
});

test('it fails to store with invalid kategori_asnaf', function () {
    $data = validMustahikData($this->kec, $this->desa);
    $data['kategori_asnaf'] = 'orang_kaya';

    $response = $this->actingAs($this->user)
        ->post(route('mustahiks.store'), $data);

    $response->assertSessionHasErrors('kategori_asnaf');
});

test('it fails to store without jenis_kelamin', function () {
    $data = validMustahikData($this->kec, $this->desa);
    $data['jenis_kelamin'] = '';

    $response = $this->actingAs($this->user)
        ->post(route('mustahiks.store'), $data);

    $response->assertSessionHasErrors('jenis_kelamin');
});

// ── STORE HAPPY PATH ──────────────────────────────────────────────────────────

test('it stores a mustahik and redirects to index', function () {
    $data = validMustahikData($this->kec, $this->desa);

    $response = $this->actingAs($this->user)
        ->post(route('mustahiks.store'), $data);

    $response->assertRedirect(route('mustahiks.index'));
    $response->assertSessionHas('success');
    expect(Mustahik::where('nama', $data['nama'])->exists())->toBeTrue();
});

test('all 8 kategori asnaf are accepted', function () {
    $kategori = ['fakir', 'miskin', 'amil', 'muallaf', 'riqab', 'gharim', 'fisabilillah', 'ibnu_sabil'];

    foreach ($kategori as $kat) {
        $data = validMustahikData($this->kec, $this->desa);
        $data['kategori_asnaf'] = $kat;

        $response = $this->actingAs($this->user)
            ->post(route('mustahiks.store'), $data);

        $response->assertSessionHasNoErrors();
    }
});

// ── EDIT ──────────────────────────────────────────────────────────────────────

test('it shows the edit mustahik form', function () {
    $mustahik = createMustahik($this->kec, $this->desa);

    $response = $this->actingAs($this->user)->get(route('mustahiks.edit', $mustahik));

    $response->assertOk();
    $response->assertViewIs('admin.mustahiks.edit');
    $response->assertViewHas('mustahik', fn ($m) => $m->id === $mustahik->id);
    $response->assertViewHas('kecamatans');
});

// ── UPDATE ────────────────────────────────────────────────────────────────────

test('it updates mustahik data', function () {
    $mustahik = createMustahik($this->kec, $this->desa);
    $data = validMustahikData($this->kec, $this->desa);
    $data['nik'] = $mustahik->nik;
    $data['nama'] = 'Nama Diperbarui';

    $this->actingAs($this->user)
        ->put(route('mustahiks.update', $mustahik), $data);

    expect($mustahik->fresh()->nama)->toBe('Nama Diperbarui');
});

test('updating with same nik does not cause unique error (self-ignore)', function () {
    $mustahik = createMustahik($this->kec, $this->desa);
    $data = validMustahikData($this->kec, $this->desa);
    $data['nik'] = $mustahik->nik;

    $response = $this->actingAs($this->user)
        ->put(route('mustahiks.update', $mustahik), $data);

    $response->assertSessionHasNoErrors();
});

test('updating with nik of another mustahik fails unique validation', function () {
    $mustahik1 = createMustahik($this->kec, $this->desa);
    $mustahik2 = createMustahik($this->kec, $this->desa);
    $data = validMustahikData($this->kec, $this->desa);
    $data['nik'] = $mustahik1->nik;

    $response = $this->actingAs($this->user)
        ->put(route('mustahiks.update', $mustahik2), $data);

    $response->assertSessionHasErrors('nik');
});

// ── DESTROY ───────────────────────────────────────────────────────────────────

test('it hard deletes a mustahik (no soft delete)', function () {
    $mustahik = createMustahik($this->kec, $this->desa);

    $response = $this->actingAs($this->user)
        ->delete(route('mustahiks.destroy', $mustahik));

    $response->assertRedirect(route('mustahiks.index'));
    $response->assertSessionHas('success');
    expect(Mustahik::find($mustahik->id))->toBeNull();
});

// ── AJAX ENDPOINTS ────────────────────────────────────────────────────────────

test('getDesa returns desas for given kecamatan', function () {
    Desa::create(['nama' => 'Desa Alpha', 'kecamatan_id' => $this->kec->id]);
    Desa::create(['nama' => 'Desa Beta', 'kecamatan_id' => $this->kec->id]);

    $response = $this->actingAs($this->user)
        ->get(route('mustahiks.getDesa', $this->kec->id));

    $response->assertOk();
    $response->assertJsonCount(3);
    $response->assertJsonFragment(['nama' => 'Desa Alpha']);
    $response->assertJsonFragment(['nama' => 'Desa Beta']);
});

test('filterByKategori returns mustahiks with given kategori', function () {
    createMustahik($this->kec, $this->desa, ['kategori_asnaf' => 'fakir']);
    createMustahik($this->kec, $this->desa, ['kategori_asnaf' => 'miskin']);

    $response = $this->actingAs($this->user)
        ->get(route('mustahiks.filterByKategori', 'fakir'));

    $response->assertOk();
    $response->assertJsonCount(1);
    $response->assertJsonFragment(['kategori_asnaf' => 'fakir']);
});

test('statistik returns correct counts', function () {
    createMustahik($this->kec, $this->desa, ['status' => 'aktif']);
    createMustahik($this->kec, $this->desa, ['status' => 'aktif']);
    createMustahik($this->kec, $this->desa, ['status' => 'nonaktif']);

    $response = $this->actingAs($this->user)
        ->get(route('mustahiks.statistik'));

    $response->assertOk();
    $response->assertJsonFragment(['total' => 3, 'aktif' => 2, 'nonaktif' => 1]);
    $response->assertJsonStructure(['total', 'aktif', 'nonaktif', 'by_kategori']);
});
