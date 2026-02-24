<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DistribusiDaging extends Model
{
    protected $fillable = [
        'unit_hewan_id',
        'peserta_id',
        'nama_penerima',
        'no_hp_penerima',
        'alamat_penerima',
        'tipe_penerima',
        'berat_kg',
        'tgl_distribusi',
        'status',
        'catatan',
    ];

    protected $casts = [
        'berat_kg'       => 'decimal:2',
        'tgl_distribusi' => 'date',
    ];

    public function unitHewan(): BelongsTo
    {
        return $this->belongsTo(UnitHewan::class, 'unit_hewan_id');
    }

    public function peserta(): BelongsTo
    {
        return $this->belongsTo(PesertaQurban::class, 'peserta_id');
    }

    public function getTipeLabelAttribute(): string
    {
        return match ($this->tipe_penerima) {
            'peserta' => 'Shohibul Qurban',
            'hadiah'  => 'Hadiah',
            'sedekah' => 'Sedekah / Fakir Miskin',
            default   => ucfirst($this->tipe_penerima),
        };
    }

    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {
            'disiapkan' => '<span class="badge bg-warning text-dark">Disiapkan</span>',
            'diterima'  => '<span class="badge bg-success">Diterima</span>',
            default     => '<span class="badge bg-light">-</span>',
        };
    }
}
