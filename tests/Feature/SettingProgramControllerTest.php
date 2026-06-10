<?php

use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

beforeEach(function () {
    $this->seed(Database\Seeders\RoleSeeder::class);
    $this->user = User::factory()->create();
    $this->user->assignRole('super-admin');
});

// ── INDEX ─────────────────────────────────────────────────────────────────────

test('it shows the program settings index page', function () {
    $response = $this->actingAs($this->user)->get(route('program.edit'));

    $response->assertOk();
    $response->assertViewIs('admin.settings.index');
    $response->assertViewHas('settings');
});

test('settings are grouped by group field', function () {
    Setting::create(['key' => 'test_key_a', 'value' => '100', 'group' => 'zakat', 'label' => 'Test A']);
    Setting::create(['key' => 'test_key_b', 'value' => '200', 'group' => 'fidyah', 'label' => 'Test B']);

    $response = $this->actingAs($this->user)->get(route('program.edit'));

    $response->assertViewHas('settings', function ($settings) {
        return $settings->has('zakat') && $settings->has('fidyah');
    });
});

// ── UPDATE ────────────────────────────────────────────────────────────────────

test('it saves settings to DB', function () {
    Setting::create(['key' => 'fidyah_price_per_day', 'value' => '50000', 'group' => 'fidyah', 'label' => 'Harga Fidyah']);

    $this->actingAs($this->user)
        ->put(route('program.settings'), [
            'settings' => ['fidyah_price_per_day' => '75000'],
        ]);

    expect(Setting::where('key', 'fidyah_price_per_day')->value('value'))->toBe('75000');
});

test('it redirects back with success after update', function () {
    Setting::create(['key' => 'test_setting', 'value' => 'old', 'group' => 'general', 'label' => 'Test']);

    $response = $this->actingAs($this->user)
        ->put(route('program.settings'), [
            'settings' => ['test_setting' => 'new'],
        ]);

    $response->assertRedirect();
    $response->assertSessionHas('success');
});

test('it fails validation without settings array', function () {
    $response = $this->actingAs($this->user)
        ->put(route('program.settings'), []);

    $response->assertSessionHasErrors('settings');
});

test('it clears setting cache after update', function () {
    Setting::create(['key' => 'fidyah_price_per_day', 'value' => '50000', 'group' => 'fidyah', 'label' => 'Harga Fidyah']);
    Cache::put('setting_fidyah_price_per_day', '50000', 3600);

    $this->actingAs($this->user)
        ->put(route('program.settings'), [
            'settings' => ['fidyah_price_per_day' => '60000'],
        ]);

    expect(Cache::has('setting_fidyah_price_per_day'))->toBeFalse();
});

// ── STATIC DEFAULTS ───────────────────────────────────────────────────────────

test('fidyahPricePerDay returns 50000 when no DB record', function () {
    expect(Setting::fidyahPricePerDay())->toBe(50000);
});

test('zakatFitrahPerJiwa returns 45000 when no DB record', function () {
    expect(Setting::zakatFitrahPerJiwa())->toBe(45000);
});

test('zakatMalPersen returns 2.5 when no DB record', function () {
    expect(Setting::zakatMalPersen())->toBe(2.5);
});

// ── STATIC FROM DB ────────────────────────────────────────────────────────────

test('fidyahPricePerDay returns DB value when set', function () {
    Setting::create(['key' => 'fidyah_price_per_day', 'value' => '50000', 'group' => 'fidyah', 'label' => 'Harga Fidyah']);
    Setting::setValue('fidyah_price_per_day', '75000');

    expect(Setting::fidyahPricePerDay())->toBe(75000);
});

test('zakatFitrahPerJiwa returns DB value when set', function () {
    Setting::create(['key' => 'zakat_fitrah_uang_per_jiwa', 'value' => '45000', 'group' => 'zakat', 'label' => 'Zakat Fitrah Per Jiwa']);
    Setting::setValue('zakat_fitrah_uang_per_jiwa', '50000');

    expect(Setting::zakatFitrahPerJiwa())->toBe(50000);
});

// ── NISAB MAL ─────────────────────────────────────────────────────────────────

test('nisabMal equals nisabEmasGram times hargaEmasPerGram', function () {
    $expected = Setting::nisabEmasGram() * Setting::hargaEmasPerGram();

    expect(Setting::nisabMal())->toBe((int) $expected);
});

// ── CACHE BEHAVIOR ────────────────────────────────────────────────────────────

test('getValue caches result under setting_{key}', function () {
    Setting::create(['key' => 'my_custom_key', 'value' => 'abc', 'group' => 'general', 'label' => 'Custom']);

    Setting::getValue('my_custom_key');

    expect(Cache::has('setting_my_custom_key'))->toBeTrue();
});

test('setValue clears the cache for that key', function () {
    Setting::create(['key' => 'fidyah_price_per_day', 'value' => '50000', 'group' => 'fidyah', 'label' => 'Harga Fidyah']);
    Cache::put('setting_fidyah_price_per_day', '50000', 3600);

    Setting::setValue('fidyah_price_per_day', '60000');

    expect(Cache::has('setting_fidyah_price_per_day'))->toBeFalse();
});
