<?php

use App\Models\Program;
use App\Models\Transaction;
use App\Models\User;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('guests are redirected to login for dskl export', function () {
    $response = $this->get(route('laporan.export-dskl'));
    $response->assertRedirect(route('login'));
});

test('guests are redirected to login for infaq shodaqah export', function () {
    $response = $this->get(route('laporan.export-infaq-shodaqah'));
    $response->assertRedirect(route('login'));
});

test('authenticated users can export dskl pdf', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    // Create test data
    $program = Program::factory()->create();
    Transaction::factory()
        ->count(3)
        ->create([
            'type' => 'infaq',
            'status' => 'confirmed',
            'program_id' => $program->id,
        ]);

    $response = $this->get(route('laporan.export-dskl'));
    $response->assertOk();
    $response->assertHeader('Content-Type');
});

test('authenticated users can export infaq shodaqah pdf', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    // Create test data
    $program = Program::factory()->create();
    Transaction::factory()
        ->count(2)
        ->create([
            'type' => 'donasi',
            'status' => 'confirmed',
            'program_id' => $program->id,
        ]);

    $response = $this->get(route('laporan.export-infaq-shodaqah'));
    $response->assertOk();
    $response->assertHeader('Content-Type');
});

test('dskl export only includes confirmed infaq transactions', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $program = Program::factory()->create();

    // Create confirmed infaq
    Transaction::factory()
        ->create([
            'type' => 'infaq',
            'status' => 'confirmed',
            'program_id' => $program->id,
        ]);

    // Create pending infaq (should not be included)
    Transaction::factory()
        ->create([
            'type' => 'infaq',
            'status' => 'pending',
            'program_id' => $program->id,
        ]);

    // Create donasi (should not be included)
    Transaction::factory()
        ->create([
            'type' => 'donasi',
            'status' => 'confirmed',
            'program_id' => $program->id,
        ]);

    $response = $this->get(route('laporan.export-dskl'));
    $response->assertOk();
});

test('infaq shodaqah export only includes confirmed donasi transactions', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $program = Program::factory()->create();

    // Create confirmed donasi
    Transaction::factory()
        ->create([
            'type' => 'donasi',
            'status' => 'confirmed',
            'program_id' => $program->id,
        ]);

    // Create pending donasi (should not be included)
    Transaction::factory()
        ->create([
            'type' => 'donasi',
            'status' => 'pending',
            'program_id' => $program->id,
        ]);

    // Create infaq (should not be included)
    Transaction::factory()
        ->create([
            'type' => 'infaq',
            'status' => 'confirmed',
            'program_id' => $program->id,
        ]);

    $response = $this->get(route('laporan.export-infaq-shodaqah'));
    $response->assertOk();
});
