<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = ['key', 'value', 'group', 'label', 'deskripsi'];

    protected $table = 'settings';

    public $timestamps = true;

    public static function getValue(string $key, mixed $default = null): mixed
    {
        return Cache::remember("setting_{$key}", 3600, function () use ($key, $default) {
            $setting = static::where('key', $key)->first();

            return $setting?->value ?? $default;
        });
    }

    public static function setValue(string $key, mixed $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
        Cache::forget("setting_{$key}");
    }

    // Shortcut helpers
    public static function fidyahPricePerDay(): int
    {
        return (int) static::getValue('fidyah_price_per_day', 50000);
    }

    public static function zakatFitrahPerJiwa(): int
    {
        return (int) static::getValue('zakat_fitrah_uang_per_jiwa', 45000);
    }

    public static function zakatMalPersen(): float
    {
        return (float) static::getValue('zakat_mal_persen', 2.5);
    }

    public static function nisabEmasGram(): float
    {
        return (float) static::getValue('nisab_emas_gram', 85);
    }

    public static function hargaEmasPerGram(): int
    {
        return (int) static::getValue('harga_emas_per_gram', 1100000);
    }

    public static function nisabMal(): int
    {
        return (int) (static::nisabEmasGram() * static::hargaEmasPerGram());
    }
}
