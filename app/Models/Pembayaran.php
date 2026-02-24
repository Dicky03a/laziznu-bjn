<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Pembayaran extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'peserta_id',
        'kode_bayar',
        'jumlah',
        'metode',
        'bank_tujuan',
        'no_rekening',
        'atas_nama',
        'tgl_bayar',
        'bukti_bayar',
        'status',
        'catatan_verifikator',
        'diverifikasi_oleh',
        'tgl_verifikasi',
    ];

    protected $casts = [
        'jumlah'         => 'decimal:2',
        'tgl_bayar'      => 'date',
        'tgl_verifikasi' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (self $model) {
            if (empty($model->kode_bayar)) {
                $model->kode_bayar = 'PAY-' . now()->year . '-' . strtoupper(Str::random(8));
            }
        });

        // Saat status berubah → sync total peserta
        static::updated(function (self $model) {
            if ($model->wasChanged('status')) {
                $model->peserta->syncStatusBayar();
            }
        });
    }

    public function peserta(): BelongsTo
    {
        return $this->belongsTo(PesertaQurban::class, 'peserta_id');
    }

    public function verifikator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'diverifikasi_oleh');
    }

    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {
            'pending'      => '<span class="badge bg-warning text-dark">Menunggu Verifikasi</span>',
            'diverifikasi' => '<span class="badge bg-success">Diverifikasi</span>',
            'ditolak'      => '<span class="badge bg-danger">Ditolak</span>',
            default        => '<span class="badge bg-light">-</span>',
        };
    }

    public function getMetodeLabelAttribute(): string
    {
        return match ($this->metode) {
            'transfer' => 'Transfer Bank',
            'tunai'    => 'Tunai',
            'qris'     => 'QRIS',
            'lainnya'  => 'Lainnya',
            default    => ucfirst($this->metode),
        };
    }
}
