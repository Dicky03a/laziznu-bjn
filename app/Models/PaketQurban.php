<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PaketQurban extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'periode_id',
        'nama_paket',
        'jenis_hewan',
        'max_peserta',
        'harga_estimasi',
        'iuran_per_peserta',
        'estimasi_bobot',
        'deskripsi',
        'is_aktif',
    ];

    protected $casts = [
        'harga_estimasi'    => 'decimal:2',
        'iuran_per_peserta' => 'decimal:2',
        'is_aktif'          => 'boolean',
    ];

    // ── Boot: auto-hitung iuran & validasi syariat ─────────────
    protected static function boot()
    {
        parent::boot();

        static::saving(function (self $model) {
            // Paksa max_peserta sesuai syariat
            if (in_array($model->jenis_hewan, ['kambing', 'domba'])) {
                $model->max_peserta = 1;
            } else {
                $model->max_peserta = min((int) $model->max_peserta, 7);
            }

            // Auto-hitung iuran
            if ($model->harga_estimasi && $model->max_peserta) {
                $model->iuran_per_peserta = $model->harga_estimasi / $model->max_peserta;
            }
        });
    }

    // ── Relations ─────────────────────────────────────────────
    public function periode(): BelongsTo
    {
        return $this->belongsTo(PeriodeQurban::class, 'periode_id');
    }

    public function unitHewans(): HasMany
    {
        return $this->hasMany(UnitHewan::class, 'paket_id');
    }

    // ── Helpers ───────────────────────────────────────────────
    public function isPatungan(): bool
    {
        return $this->max_peserta > 1;
    }

    public function getJenisHewanLabelAttribute(): string
    {
        return match ($this->jenis_hewan) {
            'sapi'    => 'Sapi',
            'unta'    => 'Unta',
            'kambing' => 'Kambing',
            'domba'   => 'Domba',
            default   => ucfirst($this->jenis_hewan),
        };
    }

    public function getJenisHewanIconAttribute(): string
    {
        return match ($this->jenis_hewan) {
            'sapi'    => '🐄',
            'unta'    => '🐪',
            'kambing' => '🐐',
            'domba'   => '🐑',
            default   => '🐄',
        };
    }
}
