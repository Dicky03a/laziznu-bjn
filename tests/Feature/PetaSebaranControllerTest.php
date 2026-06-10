<?php

use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\Mustahik;
use App\Models\Transaction;
use App\Models\User;

beforeEach(function () {
    $this->seed(Database\Seeders\RoleSeeder::class);
    $this->user = User::factory()->create();
    $this->user->assignRole('super-admin');

    $this->kec = Kecamatan::create(['nama' => 'Kecamatan Peta']);
    $this->desa = Desa::create(['nama' => 'Desa Peta', 'kecamatan_id' => $this->kec->id]);
});

function createMuzaki(Kecamatan $kec, Desa $desa, array $attrs = []): Transaction
{
    $confirmer = \App\Models\User::factory()->create();

    return Transaction::create(array_merge([
        'kode_transaksi' => 'ZKT-'.now()->format('Ymd').'-'.strtoupper(bin2hex(random_bytes(3))),
        'type' => 'zakat',
        'nama_donatur' => 'Muzaki Test '.uniqid(),
        'jumlah' => 100000,
        'status' => Transaction::STATUS_CONFIRMED,
        'confirmed_by' => $confirmer->id,
        'kecamatan_id' => $kec->id,
        'desa_id' => $desa->id,
    ], $attrs));
}

function createMustahikPeta(Kecamatan $kec, Desa $desa, array $attrs = []): Mustahik
{
    static $ctr = 0;
    $ctr++;

    return Mustahik::create(array_merge([
        'nama' => 'Mustahik Peta '.$ctr,
        'nik' => str_pad((string) (9876543210123400 + $ctr), 16, '0', STR_PAD_LEFT),
        'jenis_kelamin' => 'laki-laki',
        'kecamatan_id' => $kec->id,
        'desa_id' => $desa->id,
        'kategori_asnaf' => 'fakir',
        'status' => 'aktif',
    ], $attrs));
}

// ── INDEX ─────────────────────────────────────────────────────────────────────

test('it shows the peta sebaran index page', function () {
    $response = $this->actingAs($this->user)->get(route('peta-sebaran.index'));

    $response->assertOk();
    $response->assertViewIs('admin.peta-sebaran.index');
});

test('index passes required view variables', function () {
    $response = $this->actingAs($this->user)->get(route('peta-sebaran.index'));

    $response->assertViewHas('muzakis');
    $response->assertViewHas('mustahiks');
    $response->assertViewHas('kecamatans');
});

test('index only shows confirmed zakat transactions in muzakis', function () {
    createMuzaki($this->kec, $this->desa);
    $confirmer = \App\Models\User::factory()->create();
    Transaction::create([
        'kode_transaksi' => 'INFQ-'.now()->format('Ymd').'-'.strtoupper(bin2hex(random_bytes(3))),
        'type' => 'infaq',
        'nama_donatur' => 'Donor Infaq',
        'jumlah' => 50000,
        'status' => Transaction::STATUS_CONFIRMED,
        'confirmed_by' => $confirmer->id,
    ]);

    $response = $this->actingAs($this->user)->get(route('peta-sebaran.index'));

    $response->assertViewHas('muzakis', fn ($m) => $m->every(fn ($tx) => $tx->type === 'zakat'));
});

test('index only shows aktif mustahiks', function () {
    createMustahikPeta($this->kec, $this->desa, ['status' => 'aktif']);
    createMustahikPeta($this->kec, $this->desa, ['status' => 'nonaktif']);

    $response = $this->actingAs($this->user)->get(route('peta-sebaran.index'));

    $response->assertViewHas('mustahiks', fn ($m) => $m->every(fn ($mu) => $mu->status === 'aktif'));
});

// ── FILTER ────────────────────────────────────────────────────────────────────

test('it filters muzakis by kecamatan_id', function () {
    $kec2 = Kecamatan::create(['nama' => 'Kecamatan Lain']);
    $desa2 = Desa::create(['nama' => 'Desa Lain', 'kecamatan_id' => $kec2->id]);
    createMuzaki($this->kec, $this->desa);
    createMuzaki($kec2, $desa2);

    $response = $this->actingAs($this->user)
        ->get(route('peta-sebaran.index', ['kecamatan_id' => $this->kec->id]));

    $response->assertViewHas('muzakis', fn ($m) => $m->every(fn ($tx) => $tx->kecamatan_id === $this->kec->id));
});

test('it filters mustahiks by kecamatan_id', function () {
    $kec2 = Kecamatan::create(['nama' => 'Kec Lain Peta']);
    $desa2 = Desa::create(['nama' => 'Desa Lain Peta', 'kecamatan_id' => $kec2->id]);
    createMustahikPeta($this->kec, $this->desa);
    createMustahikPeta($kec2, $desa2);

    $response = $this->actingAs($this->user)
        ->get(route('peta-sebaran.index', ['kecamatan_id' => $this->kec->id]));

    $response->assertViewHas('mustahiks', fn ($m) => $m->every(fn ($mu) => $mu->kecamatan_id === $this->kec->id));
});

test('it filters muzakis by desa_id', function () {
    $desa2 = Desa::create(['nama' => 'Desa Kedua Peta', 'kecamatan_id' => $this->kec->id]);
    createMuzaki($this->kec, $this->desa);
    createMuzaki($this->kec, $desa2);

    $response = $this->actingAs($this->user)
        ->get(route('peta-sebaran.index', ['desa_id' => $this->desa->id]));

    $response->assertViewHas('muzakis', fn ($m) => $m->every(fn ($tx) => $tx->desa_id === $this->desa->id));
});

test('it searches muzakis by nama_donatur', function () {
    createMuzaki($this->kec, $this->desa, ['nama_donatur' => 'Haji Mahmud']);
    createMuzaki($this->kec, $this->desa, ['nama_donatur' => 'Ibu Sari']);

    $response = $this->actingAs($this->user)
        ->get(route('peta-sebaran.index', ['search' => 'Mahmud']));

    $response->assertViewHas('muzakis', fn ($m) => $m->contains('nama_donatur', 'Haji Mahmud'));
});

test('it searches mustahiks by nama', function () {
    createMustahikPeta($this->kec, $this->desa, ['nama' => 'Pak Hasan Basri']);
    createMustahikPeta($this->kec, $this->desa, ['nama' => 'Bu Aisyah Ramdan']);

    $response = $this->actingAs($this->user)
        ->get(route('peta-sebaran.index', ['search' => 'Hasan']));

    $response->assertViewHas('mustahiks', fn ($m) => $m->contains('nama', 'Pak Hasan Basri'));
});

// ── STATISTICS ────────────────────────────────────────────────────────────────

test('index passes total statistics to view', function () {
    createMuzaki($this->kec, $this->desa);
    createMuzaki($this->kec, $this->desa);
    createMustahikPeta($this->kec, $this->desa);

    $response = $this->actingAs($this->user)->get(route('peta-sebaran.index'));

    $response->assertViewHas('totalMuzaki', fn ($t) => $t >= 2);
    $response->assertViewHas('totalMustahik', fn ($t) => $t >= 1);
    $response->assertViewHas('totalKecamatan', fn ($t) => $t >= 1);
});

// ── DUAL PAGINATION ───────────────────────────────────────────────────────────

test('muzakis use default page parameter', function () {
    $response = $this->actingAs($this->user)
        ->get(route('peta-sebaran.index', ['page' => 1]));

    $response->assertOk();
    $response->assertViewHas('muzakis', fn ($m) => $m->currentPage() === 1);
});

test('mustahiks use mustahik_page parameter', function () {
    $response = $this->actingAs($this->user)
        ->get(route('peta-sebaran.index', ['mustahik_page' => 1]));

    $response->assertOk();
    $response->assertViewHas('mustahiks', fn ($m) => $m->currentPage() === 1);
});

// ── AJAX getDesa ──────────────────────────────────────────────────────────────

test('getDesa returns desas for given kecamatan_id', function () {
    Desa::create(['nama' => 'Desa Alpha Peta', 'kecamatan_id' => $this->kec->id]);

    $response = $this->actingAs($this->user)
        ->get(route('peta-sebaran.getDesa', ['kecamatan_id' => $this->kec->id]));

    $response->assertOk();
    $response->assertJsonFragment(['nama' => 'Desa Alpha Peta']);
});

test('getDesa returns empty array without kecamatan_id', function () {
    $response = $this->actingAs($this->user)
        ->get(route('peta-sebaran.getDesa'));

    $response->assertOk();
    $response->assertExactJson([]);
});

// ── EXPORT ────────────────────────────────────────────────────────────────────

test('it downloads peta sebaran export as xlsx', function () {
    createMuzaki($this->kec, $this->desa);

    $response = $this->actingAs($this->user)
        ->get(route('peta-sebaran.export'));

    $response->assertOk();
    $response->assertHeader('content-type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
});
