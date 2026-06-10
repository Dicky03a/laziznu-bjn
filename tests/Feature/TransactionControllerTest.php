<?php

use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\PaymentConfirmation;
use App\Models\Program;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    $this->seed(Database\Seeders\RoleSeeder::class);
    $this->user = User::factory()->create();
    $this->user->assignRole('super-admin');
});

function createKec(): Kecamatan
{
    return Kecamatan::create(['nama' => 'Kec. Test '.uniqid()]);
}

function createDesaFor(int $kecamatanId): Desa
{
    return Desa::create(['nama' => 'Desa Test '.uniqid(), 'kecamatan_id' => $kecamatanId]);
}

function createTx(array $attrs = []): Transaction
{
    return Transaction::create(array_merge([
        'kode_transaksi' => 'INFQ-'.now()->format('Ymd').'-'.strtoupper(bin2hex(random_bytes(3))),
        'type' => 'donasi',
        'nama_donatur' => 'Budi Santoso',
        'jumlah' => 50000,
        'status' => Transaction::STATUS_PENDING,
    ], $attrs));
}

function attachPaymentProof(Transaction $transaction): PaymentConfirmation
{
    return PaymentConfirmation::create([
        'transaction_id' => $transaction->id,
        'nama_pengirim' => $transaction->nama_donatur,
        'bank_pengirim' => 'BCA',
        'jumlah_transfer' => $transaction->jumlah,
        'tanggal_transfer' => now()->toDateString(),
    ]);
}

// ── INDEX ─────────────────────────────────────────────────────────────────────

test('it shows the transaction index page', function () {
    $response = $this->actingAs($this->user)->get(route('transactions.index'));

    $response->assertOk();
    $response->assertViewIs('admin.transactions.index');
    $response->assertViewHas('transactions');
});

test('it filters transactions by status', function () {
    createTx(['status' => Transaction::STATUS_PENDING]);
    createTx(['status' => Transaction::STATUS_CONFIRMED, 'confirmed_by' => $this->user->id]);

    $response = $this->actingAs($this->user)
        ->get(route('transactions.index', ['status' => 'pending']));

    $response->assertOk();
    $response->assertViewHas('transactions', fn ($t) => $t->every(fn ($tx) => $tx->status === 'pending'));
});

test('it filters transactions by search (nama_donatur)', function () {
    createTx(['nama_donatur' => 'Ahmad Fauzi']);
    createTx(['nama_donatur' => 'Budi Santoso']);

    $response = $this->actingAs($this->user)
        ->get(route('transactions.index', ['search' => 'Ahmad']));

    $response->assertOk();
    $response->assertViewHas('transactions', fn ($t) => $t->contains('nama_donatur', 'Ahmad Fauzi'));
});

test('index passes stats to view', function () {
    $response = $this->actingAs($this->user)->get(route('transactions.index'));

    $response->assertOk();
    $response->assertViewHas('stats');
});

// ── CREATE ────────────────────────────────────────────────────────────────────

test('it shows the create transaction form', function () {
    $response = $this->actingAs($this->user)->get(route('transactions.create'));

    $response->assertOk();
    $response->assertViewIs('admin.transactions.create');
    $response->assertViewHas('programs');
    $response->assertViewHas('kecamatans');
});

// ── STORE VALIDATION ──────────────────────────────────────────────────────────

test('it fails to store without type', function () {
    $response = $this->actingAs($this->user)
        ->post(route('transactions.store'), [
            'nama_donatur' => 'Test', 'jumlah' => 50000,
        ]);

    $response->assertSessionHasErrors('type');
});

test('it fails to store with invalid type', function () {
    $response = $this->actingAs($this->user)
        ->post(route('transactions.store'), [
            'type' => 'qurban', 'nama_donatur' => 'Test', 'jumlah' => 50000,
        ]);

    $response->assertSessionHasErrors('type');
});

test('it fails to store without nama_donatur', function () {
    $response = $this->actingAs($this->user)
        ->post(route('transactions.store'), [
            'type' => 'donasi', 'jumlah' => 50000,
        ]);

    $response->assertSessionHasErrors('nama_donatur');
});

test('it fails to store with jumlah below minimum', function () {
    $response = $this->actingAs($this->user)
        ->post(route('transactions.store'), [
            'type' => 'donasi', 'nama_donatur' => 'Test', 'jumlah' => 500,
        ]);

    $response->assertSessionHasErrors('jumlah');
});

test('it fails to store zakat mal without nilai_harta', function () {
    $response = $this->actingAs($this->user)
        ->post(route('transactions.store'), [
            'type' => 'zakat',
            'zakat_jenis' => 'mal',
            'nama_donatur' => 'Test',
            'jumlah' => 50000,
        ]);

    $response->assertSessionHasErrors('nilai_harta');
});

test('it fails to store fidyah without jumlah_hari', function () {
    $response = $this->actingAs($this->user)
        ->post(route('transactions.store'), [
            'type' => 'fidyah',
            'nama_donatur' => 'Test',
            'jumlah' => 50000,
        ]);

    $response->assertSessionHasErrors('jumlah_hari');
});

// ── STORE HAPPY PATH ──────────────────────────────────────────────────────────

test('admin manual create results in confirmed status', function () {
    $response = $this->actingAs($this->user)
        ->post(route('transactions.store'), [
            'type' => 'donasi',
            'nama_donatur' => 'Agus Salim',
            'jumlah' => 100000,
        ]);

    $transaction = Transaction::where('nama_donatur', 'Agus Salim')->first();
    expect($transaction)->not->toBeNull();
    expect($transaction->status)->toBe(Transaction::STATUS_CONFIRMED);
    expect($transaction->confirmed_by)->toBe($this->user->id);
});

test('admin manual create redirects to show page', function () {
    $response = $this->actingAs($this->user)
        ->post(route('transactions.store'), [
            'type' => 'infaq',
            'nama_donatur' => 'Siti Rahayu',
            'jumlah' => 75000,
        ]);

    $transaction = Transaction::where('nama_donatur', 'Siti Rahayu')->first();
    $response->assertRedirect(route('transactions.show', $transaction));
    $response->assertSessionHas('success');
});

test('admin manual create zakat with program_id skips zakat_jenis', function () {
    $program = Program::create([
        'type' => 'zakat', 'nama' => 'Program Zakat Fitrah',
        'slug' => 'program-zakat-fitrah', 'deskripsi' => 'Desc',
        'is_active' => true,
    ]);

    $response = $this->actingAs($this->user)
        ->post(route('transactions.store'), [
            'type' => 'zakat',
            'program_id' => $program->id,
            'nama_donatur' => 'Donor Zakat',
            'jumlah' => 50000,
        ]);

    $response->assertSessionHasNoErrors();
});

// ── SHOW ──────────────────────────────────────────────────────────────────────

test('it shows a transaction detail page', function () {
    $tx = createTx();

    $response = $this->actingAs($this->user)->get(route('transactions.show', $tx));

    $response->assertOk();
    $response->assertViewIs('admin.transactions.show');
    $response->assertViewHas('transaction', fn ($t) => $t->id === $tx->id);
});

// ── CONFIRM ───────────────────────────────────────────────────────────────────

test('it confirms a pending transaction with payment confirmation', function () {
    $tx = createTx();
    attachPaymentProof($tx);

    $response = $this->actingAs($this->user)
        ->post(route('transactions.confirm', $tx));

    $response->assertRedirect(route('transactions.show', $tx));
    $response->assertSessionHas('success');
    expect($tx->fresh()->status)->toBe(Transaction::STATUS_CONFIRMED);
});

test('it cannot confirm a non-pending transaction', function () {
    $tx = createTx(['status' => Transaction::STATUS_CONFIRMED, 'confirmed_by' => $this->user->id]);
    attachPaymentProof($tx);

    $response = $this->actingAs($this->user)
        ->post(route('transactions.confirm', $tx));

    $response->assertRedirect();
    $response->assertSessionHas('error');
});

test('it cannot confirm without payment confirmation', function () {
    $tx = createTx();

    $response = $this->actingAs($this->user)
        ->post(route('transactions.confirm', $tx));

    $response->assertRedirect();
    $response->assertSessionHas('error');
    expect($tx->fresh()->status)->toBe(Transaction::STATUS_PENDING);
});

// ── REJECT ────────────────────────────────────────────────────────────────────

test('it rejects a pending transaction with catatan_admin', function () {
    $tx = createTx();

    $response = $this->actingAs($this->user)
        ->post(route('transactions.reject', $tx), [
            'catatan_admin' => 'Bukti transfer tidak valid.',
        ]);

    $response->assertRedirect(route('transactions.show', $tx));
    $response->assertSessionHas('success');
    expect($tx->fresh()->status)->toBe(Transaction::STATUS_REJECTED);
});

test('it fails to reject without catatan_admin', function () {
    $tx = createTx();

    $response = $this->actingAs($this->user)
        ->post(route('transactions.reject', $tx), ['catatan_admin' => '']);

    $response->assertSessionHasErrors('catatan_admin');
    expect($tx->fresh()->status)->toBe(Transaction::STATUS_PENDING);
});

test('it cannot reject a non-pending transaction', function () {
    $tx = createTx(['status' => Transaction::STATUS_CONFIRMED, 'confirmed_by' => $this->user->id]);

    $response = $this->actingAs($this->user)
        ->post(route('transactions.reject', $tx), [
            'catatan_admin' => 'Alasan penolakan.',
        ]);

    $response->assertRedirect();
    $response->assertSessionHas('error');
});

// ── EXPORT ────────────────────────────────────────────────────────────────────

test('it downloads transaction export as xlsx', function () {
    createTx();

    $response = $this->actingAs($this->user)
        ->get(route('transactions.export'));

    $response->assertOk();
    $response->assertHeader('content-type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
});

// ── MODEL ─────────────────────────────────────────────────────────────────────

test('transaction model has STATUS constants', function () {
    expect(Transaction::STATUS_PENDING)->toBe('pending');
    expect(Transaction::STATUS_CONFIRMED)->toBe('confirmed');
    expect(Transaction::STATUS_REJECTED)->toBe('rejected');
});

test('transaction model has TYPE constants', function () {
    expect(Transaction::TYPE_ZAKAT)->toBe('zakat');
    expect(Transaction::TYPE_INFAQ)->toBe('infaq');
    expect(Transaction::TYPE_DONASI)->toBe('donasi');
    expect(Transaction::TYPE_FIDYAH)->toBe('fidyah');
});

test('nama_tampil returns Hamba Allah when is_anonim', function () {
    $tx = createTx(['nama_donatur' => 'Budi', 'is_anonim' => true]);

    expect($tx->nama_tampil)->toBe('Hamba Allah');
});

test('nama_tampil returns nama_donatur when not anonim', function () {
    $tx = createTx(['nama_donatur' => 'Budi Santoso', 'is_anonim' => false]);

    expect($tx->nama_tampil)->toBe('Budi Santoso');
});

test('generateKode returns formatted string with prefix and date', function () {
    $kode = Transaction::generateKode('donasi');

    expect($kode)->toMatch('/^[A-Z]+-\d{8}-[A-F0-9]{6}$/');
});

test('is_pending returns true for pending transaction', function () {
    $tx = createTx(['status' => Transaction::STATUS_PENDING]);

    expect($tx->is_pending)->toBeTrue();
    expect($tx->is_confirmed)->toBeFalse();
});
