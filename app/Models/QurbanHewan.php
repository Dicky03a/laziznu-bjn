<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class QurbanHewan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'qurban_hewans';

    protected $fillable = [
        'period_id',
        'jenis',
        'nama',
        'deskripsi',
        'berat_estimasi',
        'gambar',
        'harga_total',
        'harga_per_slot',
        'max_peserta',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'harga_total' => 'integer',
        'harga_per_slot' => 'integer',
        'max_peserta' => 'integer',
    ];

    const JENIS_PATUNGAN = ['sapi', 'unta'];

    const JENIS_PERORANGAN = ['kambing', 'domba'];

    const MAX_PESERTA_MAP = [
        'sapi' => 7,
        'unta' => 7,
        'kambing' => 1,
        'domba' => 1,
    ];

    const JENIS_LABELS = [
        'sapi' => 'Sapi',
        'unta' => 'Unta',
        'kambing' => 'Kambing',
        'domba' => 'Domba',
    ];

    const JENIS_ICONS = [
        'sapi' => '🐄',
        'unta' => '🐪',
        'kambing' => '🐐',
        'domba' => '🐑',
    ];

    public function period(): BelongsTo
    {
        return $this->belongsTo(QurbanPeriod::class, 'period_id');
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(QurbanRegistration::class, 'hewan_id');
    }

    public function confirmedRegistrations(): HasMany
    {
        return $this->hasMany(QurbanRegistration::class, 'hewan_id')
            ->where('status', 'confirmed');
    }

    public function activeRegistrations(): HasMany
    {
        return $this->hasMany(QurbanRegistration::class, 'hewan_id')
            ->whereIn('status', ['pending', 'confirmed']);
    }

    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', true);
    }

    public function scopeOfJenis(Builder $query, string $jenis): void
    {
        $query->where('jenis', $jenis);
    }

    public function scopePatungan(Builder $query): void
    {
        $query->whereIn('jenis', self::JENIS_PATUNGAN);
    }

    public function scopePerorangan(Builder $query): void
    {
        $query->whereIn('jenis', self::JENIS_PERORANGAN);
    }

    public function getIsPatunganAttribute(): bool
    {
        return in_array($this->jenis, self::JENIS_PATUNGAN);
    }

    public function getJenisLabelAttribute(): string
    {
        return self::JENIS_LABELS[$this->jenis] ?? $this->jenis;
    }

    public function getJenisIconAttribute(): string
    {
        return self::JENIS_ICONS[$this->jenis] ?? '🐄';
    }

    public function getSlotTerisiAttribute(): int
    {
        return $this->activeRegistrations()->count();
    }

    public function getSlotTersediaAttribute(): int
    {
        return max(0, $this->max_peserta - $this->slot_terisi);
    }

    public function getIsPenuhAttribute(): bool
    {
        return $this->slot_tersedia <= 0;
    }

    public function getProgressPersenAttribute(): float
    {
        if ($this->max_peserta === 0) {
            return 0;
        }

        return min(100, round(($this->slot_terisi / $this->max_peserta) * 100));
    }

    public function getHargaTotalFormatAttribute(): string
    {
        return 'Rp '.number_format($this->harga_total, 0, ',', '.');
    }

    public function getHargaPerSlotFormatAttribute(): string
    {
        return 'Rp '.number_format($this->harga_per_slot, 0, ',', '.');
    }

    public function getGambarUrlAttribute(): string
    {
        return $this->gambar
            ? asset('storage/'.$this->gambar)
            : asset('images/default-hewan.jpg');
    }

    public function getStatusSlotAttribute(): string
    {
        $sisa = $this->slot_tersedia;

        if ($sisa <= 0) {
            return 'penuh';
        }
        if ($sisa === 1) {
            return 'hampir_penuh';
        }
        if ($sisa <= $this->max_peserta / 2) {
            return 'terbatas';
        }

        return 'tersedia';
    }

    public function getStatusSlotLabelAttribute(): string
    {
        return match ($this->status_slot) {
            'penuh' => 'PENUH',
            'hampir_penuh' => '1 Slot Tersisa!',
            'terbatas' => $this->slot_tersedia.' Slot Tersisa',
            default => 'Tersedia',
        };
    }

    public function getStatusSlotColorAttribute(): string
    {
        return match ($this->status_slot) {
            'penuh' => 'red',
            'hampir_penuh' => 'orange',
            'terbatas' => 'yellow',
            default => 'emerald',
        };
    }

    public static function buildFromJenis(array $data): array
    {
        $maxPeserta = self::MAX_PESERTA_MAP[$data['jenis']] ?? 1;
        $hargaTotal = (int) $data['harga_total'];

        return array_merge($data, [
            'max_peserta' => $maxPeserta,
            'harga_per_slot' => (int) ceil($hargaTotal / $maxPeserta),
        ]);
    }
}
