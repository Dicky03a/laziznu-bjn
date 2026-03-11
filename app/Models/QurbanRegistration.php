<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class QurbanRegistration extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'qurban_registrations';

    protected $fillable = [
        'kode_registrasi',
        'hewan_id',
        'period_id',
        'nama_peserta',
        'atas_nama',
        'email',
        'telepon',
        'alamat',
        'catatan',
        'jumlah_slot',
        'harga_per_slot',
        'total_bayar',
        'status',
        'catatan_admin',
        'confirmed_at',
        'confirmed_by',
        'payment_gateway',
        'gateway_transaction_id',
        'gateway_status',
    ];

    protected $casts = [
        'jumlah_slot' => 'integer',
        'harga_per_slot' => 'integer',
        'total_bayar' => 'integer',
        'confirmed_at' => 'datetime',
    ];

    const STATUS_PENDING = 'pending';

    const STATUS_CONFIRMED = 'confirmed';

    const STATUS_CANCELLED = 'cancelled';

    const STATUS_LABELS = [
        'pending' => 'Menunggu Konfirmasi',
        'confirmed' => 'Terkonfirmasi',
        'cancelled' => 'Dibatalkan',
    ];

    const STATUS_COLORS = [
        'pending' => 'yellow',
        'confirmed' => 'emerald',
        'cancelled' => 'red',
    ];

    public function hewan(): BelongsTo
    {
        return $this->belongsTo(QurbanHewan::class, 'hewan_id');
    }

    public function period(): BelongsTo
    {
        return $this->belongsTo(QurbanPeriod::class, 'period_id');
    }

    public function confirmedBy(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'confirmed_by');
    }

    public function paymentConfirmation(): HasOne
    {
        return $this->hasOne(QurbanPaymentConfirmation::class, 'registration_id');
    }

    public function scopePending(Builder $query): void
    {
        $query->where('status', self::STATUS_PENDING);
    }

    public function scopeConfirmed(Builder $query): void
    {
        $query->where('status', self::STATUS_CONFIRMED);
    }

    public function scopeCancelled(Builder $query): void
    {
        $query->where('status', self::STATUS_CANCELLED);
    }

    public function scopeActive(Builder $query): void
    {
        $query->whereIn('status', [self::STATUS_PENDING, self::STATUS_CONFIRMED]);
    }

    public function scopeOfPeriod(Builder $query, int $periodId): void
    {
        $query->where('period_id', $periodId);
    }

    public function getStatusLabelAttribute(): string
    {
        return self::STATUS_LABELS[$this->status] ?? $this->status;
    }

    public function getStatusColorAttribute(): string
    {
        return self::STATUS_COLORS[$this->status] ?? 'gray';
    }

    public function getIsPendingAttribute(): bool
    {
        return $this->status === self::STATUS_PENDING;
    }

    public function getIsConfirmedAttribute(): bool
    {
        return $this->status === self::STATUS_CONFIRMED;
    }

    public function getIsCancelledAttribute(): bool
    {
        return $this->status === self::STATUS_CANCELLED;
    }

    public function getTotalBayarFormatAttribute(): string
    {
        return 'Rp '.number_format($this->total_bayar, 0, ',', '.');
    }

    public function getHargaPerSlotFormatAttribute(): string
    {
        return 'Rp '.number_format($this->harga_per_slot, 0, ',', '.');
    }

    public function getNamaTampilAttribute(): string
    {
        return $this->atas_nama ?: $this->nama_peserta;
    }

    public static function generateKode(): string
    {
        $date = now()->format('Ymd');
        $random = strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 6));

        return "QRB-{$date}-{$random}";
    }
}
