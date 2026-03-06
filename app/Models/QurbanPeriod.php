<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QurbanPeriod extends Model
{
    use HasFactory;

    protected $table = 'qurban_periods';

    protected $fillable = [
        'nama',
        'tahun',
        'deskripsi',
        'is_active',
        'tanggal_buka',
        'tanggal_tutup',
        'tanggal_pelaksanaan',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'tahun' => 'integer',
        'tanggal_buka' => 'date',
        'tanggal_tutup' => 'date',
        'tanggal_pelaksanaan' => 'date',
    ];

    public function hewanList(): HasMany
    {
        return $this->hasMany(QurbanHewan::class, 'period_id');
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(QurbanRegistration::class, 'period_id');
    }

    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', true);
    }

    public function getIsOpenAttribute(): bool
    {
        if (! $this->is_active) {
            return false;
        }

        $now = now()->toDateString();

        if ($this->tanggal_buka && $now < $this->tanggal_buka->toDateString()) {
            return false;
        }

        if ($this->tanggal_tutup && $now > $this->tanggal_tutup->toDateString()) {
            return false;
        }

        return true;
    }

    public function getStatusDaftarAttribute(): string
    {
        if (! $this->is_active) {
            return 'nonaktif';
        }

        $now = now()->toDateString();

        if ($this->tanggal_buka && $now < $this->tanggal_buka->toDateString()) {
            return 'belum_buka';
        }

        if ($this->tanggal_tutup && $now > $this->tanggal_tutup->toDateString()) {
            return 'tutup';
        }

        return 'buka';
    }

    public function getStatusDaftarLabelAttribute(): string
    {
        return match ($this->status_daftar) {
            'buka' => 'Pendaftaran Terbuka',
            'belum_buka' => 'Segera Dibuka',
            'tutup' => 'Pendaftaran Ditutup',
            default => 'Tidak Aktif',
        };
    }

    public function getTotalTerkumpulAttribute(): int
    {
        return $this->registrations()
            ->where('status', 'confirmed')
            ->sum('total_bayar');
    }

    public function activate(): void
    {
        static::where('id', '!=', $this->id)->update(['is_active' => false]);
        $this->update(['is_active' => true]);
    }
}
