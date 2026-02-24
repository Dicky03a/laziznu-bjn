<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UnitHewan extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'paket_id',
        'nomor_unit',
        'kuota',
        'terisi',
        'status',
        'nama_hewan',
        'foto_hewan',
        'tgl_beli',
        'harga_aktual',
        'nama_penjual',
        'lokasi_penyembelihan',
        'tgl_sembelih',
        'nama_juru_sembelih',
        'catatan',
    ];

    protected $casts = [
        'tgl_beli'     => 'date',
        'tgl_sembelih' => 'date',
        'harga_aktual' => 'decimal:2',
    ];

    // ── Relations ─────────────────────────────────────────────
    public function paket(): BelongsTo
    {
        return $this->belongsTo(PaketQurban::class, 'paket_id');
    }

    public function pesertas(): HasMany
    {
        return $this->hasMany(PesertaQurban::class, 'unit_hewan_id');
    }

    public function distribusiDagings(): HasMany
    {
        return $this->hasMany(DistribusiDaging::class, 'unit_hewan_id');
    }

    // ── Helpers ───────────────────────────────────────────────
    public function isFull(): bool
    {
        return $this->terisi >= $this->kuota;
    }

    public function sisaSlot(): int
    {
        return max(0, $this->kuota - $this->terisi);
    }

    public function getProgressPersenAttribute(): float
    {
        return $this->kuota > 0 ? round(($this->terisi / $this->kuota) * 100) : 0;
    }

    // Generate nomor unit otomatis berdasarkan paket & sequence
    public static function generateNomorUnit(PaketQurban $paket): string
    {
        $prefix = match ($paket->jenis_hewan) {
            'sapi'    => 'SPI',
            'unta'    => 'UNT',
            'kambing' => 'KMB',
            'domba'   => 'DMB',
        };
        $tahun   = now()->year;
        $urutan  = self::whereHas('paket', fn($q) => $q->where('periode_id', $paket->periode_id)
            ->where('jenis_hewan', $paket->jenis_hewan))->count() + 1;

        return sprintf('%s-%d-%03d', $prefix, $tahun, $urutan);
    }

    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {
            'open'       => '<span class="badge bg-success">Open</span>',
            'penuh'      => '<span class="badge bg-primary">Penuh</span>',
            'terbeli'    => '<span class="badge bg-info">Sudah Dibeli</span>',
            'disembelih' => '<span class="badge bg-warning text-dark">Disembelih</span>',
            'selesai'    => '<span class="badge bg-secondary">Selesai</span>',
            default      => '<span class="badge bg-light">-</span>',
        };
    }
}
