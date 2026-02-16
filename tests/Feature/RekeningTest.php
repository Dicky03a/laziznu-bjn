<?php

namespace Tests\Feature;

use App\Models\Rekening;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

test('can view rekenings index', function () {
    actingAs(User::factory()->create());
    Rekening::factory(3)->create();

    $response = get(route('rekenings.index'));

    $response->assertStatus(200);
    $response->assertViewHas('rekenings');
});

test('can view create rekening form', function () {
    actingAs(User::factory()->create());

    $response = get(route('rekenings.create'));

    $response->assertStatus(200);
});

test('can create rekening', function () {
    actingAs(User::factory()->create());

    $data = [
        'nama' => 'Bank Mandiri',
        'bank_atas_nama' => 'John Doe',
        'nomor_rekening' => '1234567890123456',
    ];

    $response = post(route('rekenings.store'), $data);

    $response->assertRedirect(route('rekenings.index'));
    assertDatabaseHas('rekenings', $data);
});

test('can create rekening with icon', function () {
    Storage::fake('public');
    actingAs(User::factory()->create());

    $file = UploadedFile::fake()->image('bank-icon.png', 100, 100);

    $data = [
        'nama' => 'Bank BCA',
        'bank_atas_nama' => 'Jane Doe',
        'nomor_rekening' => '9876543210987654',
        'icon' => $file,
    ];

    $response = post(route('rekenings.store'), $data);

    $response->assertRedirect(route('rekenings.index'));
    assertDatabaseHas('rekenings', [
        'nama' => 'Bank BCA',
        'bank_atas_nama' => 'Jane Doe',
        'nomor_rekening' => '9876543210987654',
    ]);
});

test('can view edit rekening form', function () {
    actingAs(User::factory()->create());
    $rekening = Rekening::factory()->create();

    $response = get(route('rekenings.edit', $rekening));

    $response->assertStatus(200);
    $response->assertViewHas('rekening', $rekening);
});

test('can update rekening', function () {
    actingAs(User::factory()->create());
    $rekening = Rekening::factory()->create();

    $data = [
        'nama' => 'Bank BRI Updated',
        'bank_atas_nama' => 'Updated Name',
        'nomor_rekening' => '1111222233334444',
    ];

    $response = put(route('rekenings.update', $rekening), $data);

    $response->assertRedirect(route('rekenings.index'));
    assertDatabaseHas('rekenings', array_merge(['id' => $rekening->id], $data));
});

test('can delete rekening', function () {
    actingAs(User::factory()->create());
    $rekening = Rekening::factory()->create();

    $response = delete(route('rekenings.destroy', $rekening));

    $response->assertRedirect(route('rekenings.index'));
    assertDatabaseMissing('rekenings', ['id' => $rekening->id]);
});

test('nama must be unique', function () {
    actingAs(User::factory()->create());
    Rekening::factory()->create(['nama' => 'Bank Mandiri']);

    $data = [
        'nama' => 'Bank Mandiri',
        'bank_atas_nama' => 'John Doe',
        'nomor_rekening' => '1234567890123456',
    ];

    $response = post(route('rekenings.store'), $data);

    $response->assertSessionHasErrors('nama');
});

test('nomor rekening must be unique', function () {
    actingAs(User::factory()->create());
    Rekening::factory()->create(['nomor_rekening' => '1234567890123456']);

    $data = [
        'nama' => 'Bank BCA',
        'bank_atas_nama' => 'Jane Doe',
        'nomor_rekening' => '1234567890123456',
    ];

    $response = post(route('rekenings.store'), $data);

    $response->assertSessionHasErrors('nomor_rekening');
});

test('icon must be image', function () {
    Storage::fake('public');
    actingAs(User::factory()->create());

    $file = UploadedFile::fake()->create('document.pdf', 100);

    $data = [
        'nama' => 'Bank BTN',
        'bank_atas_nama' => 'Test User',
        'nomor_rekening' => '5555666677778888',
        'icon' => $file,
    ];

    $response = post(route('rekenings.store'), $data);

    $response->assertSessionHasErrors('icon');
});
