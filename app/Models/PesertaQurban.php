<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class PesertaQurban extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'unit_hewan_id',
        'user_id',
        'kode_tracking',
        'nama_shohibul_qurban',
        'no_hp',
        'email',
        'alamat',
        'no_urut_dalam_unit',
        'total_tagihan',
        'total_dibayar',
        'status_bayar',
        'status_peserta',
        'tgl_daftar',
        'catatan',
    ];

    protected $casts = [
        'total_tagihan' => 'decimal:2',
        'total_dibayar' => 'decimal:2',
        'tgl_daftar'    => 'date',
    ];

    // ── Boot: auto-generate kode tracking ─────────────────────
    protected static function boot()
    {
        parent::boot();

        static::creating(function (self $model) {
            if (empty($model->kode_tracking)) {
                $model->kode_tracking = self::generateKodeTracking();
            }
            if (empty($model->tgl_daftar)) {
                $model->tgl_daftar = now()->toDateString();
            }
        });
    }

    public static function generateKodeTracking(): string
    {
        do {
            $kode = 'QRB-' . now()->year . '-' . strtoupper(Str::random(6));
        } while (self::where('kode_tracking', $kode)->exists());

        return $kode;
    }

    // ── Relations ─────────────────────────────────────────────
    public function unitHewan(): BelongsTo
    {
        return $this->belongsTo(UnitHewan::class, 'unit_hewan_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function pembayarans(): HasMany
    {
        return $this->hasMany(Pembayaran::class, 'peserta_id');
    }

    public function distribusiDagings(): HasMany
    {
        return $this->hasMany(DistribusiDaging::class, 'peserta_id');
    }

    // ── Computed ──────────────────────────────────────────────
    public function getSisaTagihanAttribute(): float
    {
        return max(0, $this->total_tagihan - $this->total_dibayar);
    }

    public function syncStatusBayar(): void
    {
        $dibayar = $this->pembayarans()->where('status', 'diverifikasi')->sum('jumlah');
        $this->total_dibayar = $dibayar;

        if ($dibayar <= 0) {
            $this->status_bayar = 'belum';
        } elseif ($dibayar < $this->total_tagihan) {
            $this->status_bayar = 'sebagian';
        } else {
            $this->status_bayar = 'lunas';
        }

        $this->save();
    }

    public function getStatusBayarBadgeAttribute(): string
    {
        return match ($this->status_bayar) {
            'belum'    => '<span class="badge bg-danger">Belum Bayar</span>',
            'sebagian' => '<span class="badge bg-warning text-dark">Sebagian</span>',
            'lunas'    => '<span class="badge bg-success">Lunas</span>',
            default    => '<span class="badge bg-light">-</span>',
        };
    }

    public function getStatusPesertaBadgeAttribute(): string
    {
        return match ($this->status_peserta) {
            'terdaftar'  => '<span class="badge bg-secondary">Terdaftar</span>',
            'aktif'      => '<span class="badge bg-primary">Aktif</span>',
            'selesai'    => '<span class="badge bg-success">Selesai</span>',
            'dibatalkan' => '<span class="badge bg-danger">Dibatalkan</span>',
            default      => '<span class="badge bg-light">-</span>',
        };
    }

    // Timeline tracking untuk halaman publik
    public function getTimelineAttribute(): array
    {
        $unit = $this->unitHewan;
        $timeline = [];

        $timeline[] = [
            'status' => 'done',
            'label'  => 'Pendaftaran',
            'desc'   => 'Terdaftar pada ' . $this->tgl_daftar->translatedFormat('d F Y'),
            'icon'   => 'bi-person-check',
        ];

        $timeline[] = [
            'status' => $this->status_bayar === 'lunas' ? 'done' : ($this->status_bayar === 'sebagian' ? 'progress' : 'pending'),
            'label'  => 'Pembayaran',
            'desc'   => $this->status_bayar === 'lunas'
                ? 'Lunas – Rp ' . number_format($this->total_dibayar, 0, ',', '.')
                : 'Dibayar Rp ' . number_format($this->total_dibayar, 0, ',', '.') . ' dari Rp ' . number_format($this->total_tagihan, 0, ',', '.'),
            'icon'   => 'bi-cash-coin',
        ];

        $timeline[] = [
            'status' => in_array($unit->status, ['terbeli', 'disembelih', 'selesai']) ? 'done' : 'pending',
            'label'  => 'Pembelian Hewan',
            'desc'   => $unit->tgl_beli ? 'Dibeli pada ' . $unit->tgl_beli->translatedFormat('d F Y') : 'Menunggu pembelian',
            'icon'   => 'bi-bag-check',
        ];

        $timeline[] = [
            'status' => in_array($unit->status, ['disembelih', 'selesai']) ? 'done' : 'pending',
            'label'  => 'Penyembelihan',
            'desc'   => $unit->tgl_sembelih ? 'Disembelih pada ' . $unit->tgl_sembelih->translatedFormat('d F Y') : 'Menunggu pelaksanaan',
            'icon'   => 'bi-calendar-event',
        ];

        $timeline[] = [
            'status' => $unit->status === 'selesai' ? 'done' : 'pending',
            'label'  => 'Distribusi Daging',
            'desc'   => $unit->status === 'selesai' ? 'Daging telah didistribusikan' : 'Menunggu distribusi',
            'icon'   => 'bi-gift',
        ];

        return $timeline;
    }
}
