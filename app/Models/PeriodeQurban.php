<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class PeriodeQurban extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nama',
        'tahun_hijriah',
        'tahun_masehi',
        'tgl_buka_pendaftaran',
        'tgl_tutup_pembayaran',
        'tgl_pelaksanaan',
        'deskripsi',
        'status',
    ];

    protected $casts = [
        'tgl_buka_pendaftaran' => 'date',
        'tgl_tutup_pembayaran' => 'date',
        'tgl_pelaksanaan'      => 'date',
    ];

    // ── Relations ─────────────────────────────────────────────
    public function pakets(): HasMany
    {
        return $this->hasMany(PaketQurban::class, 'periode_id');
    }

    public function unitHewans(): HasManyThrough
    {
        return $this->hasManyThrough(UnitHewan::class, PaketQurban::class, 'periode_id', 'paket_id');
    }

    // ── Scopes ────────────────────────────────────────────────
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    // ── Accessors ─────────────────────────────────────────────
    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {
            'draft'   => '<span class="badge bg-secondary">Draft</span>',
            'aktif'   => '<span class="badge bg-success">Aktif</span>',
            'ditutup' => '<span class="badge bg-warning text-dark">Ditutup</span>',
            'selesai' => '<span class="badge bg-info">Selesai</span>',
            default   => '<span class="badge bg-light">-</span>',
        };
    }

    public function getTotalPesertaAttribute(): int
    {
        return $this->unitHewans()->withCount('pesertas')->get()->sum('pesertas_count');
    }
}
