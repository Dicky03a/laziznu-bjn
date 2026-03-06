<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'kode_transaksi',
        'type',
        'program_id',
        'nama_donatur',
        'email',
        'telepon',
        'kecamatan_id',
        'desa_id',
        'is_anonim',
        'jumlah',
        'metadata',
        'catatan',
        'status',
        'confirmed_at',
        'confirmed_by',
        'catatan_admin',
        'payment_gateway',
        'gateway_transaction_id',
        'gateway_status',
    ];

    protected $casts = [
        'is_anonim' => 'boolean',
        'jumlah' => 'integer',
        'metadata' => 'array',
        'confirmed_at' => 'datetime',
    ];

    const STATUS_PENDING = 'pending';

    const STATUS_CONFIRMED = 'confirmed';

    const STATUS_REJECTED = 'rejected';

    const TYPE_ZAKAT = 'zakat';

    const TYPE_INFAQ = 'infaq';

    const TYPE_DONASI = 'donasi';

    const TYPE_FIDYAH = 'fidyah';

    const TYPE_LABELS = [
        'zakat' => 'Zakat',
        'infaq' => 'Infaq',
        'donasi' => 'Donasi',
        'fidyah' => 'Fidyah',
    ];

    const STATUS_LABELS = [
        'pending' => 'Menunggu',
        'confirmed' => 'Dikonfirmasi',
        'rejected' => 'Ditolak',
    ];

    const STATUS_COLORS = [
        'pending' => 'yellow',
        'confirmed' => 'green',
        'rejected' => 'red',
    ];

    const TYPE_PREFIXES = [
        'zakat' => 'ZKT',
        'infaq' => 'IFQ',
        'donasi' => 'DNS',
        'fidyah' => 'FDY',
    ];

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    public function kecamatan(): BelongsTo
    {
        return $this->belongsTo(Kecamatan::class);
    }

    public function desa(): BelongsTo
    {
        return $this->belongsTo(Desa::class);
    }

    public function confirmedBy(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'confirmed_by');
    }

    public function paymentConfirmation(): HasOne
    {
        return $this->hasOne(PaymentConfirmation::class);
    }

    public function scopeOfType(Builder $query, string $type): void
    {
        $query->where('type', $type);
    }

    public function scopeWithStatus(Builder $query, string $status): void
    {
        $query->where('status', $status);
    }

    public function scopePending(Builder $query): void
    {
        $query->where('status', self::STATUS_PENDING);
    }

    public function scopeConfirmed(Builder $query): void
    {
        $query->where('status', self::STATUS_CONFIRMED);
    }

    public function getNamaTampilAttribute(): string
    {
        return $this->is_anonim ? 'Hamba Allah' : $this->nama_donatur;
    }

    public function getAlamatLengkapAttribute(): string
    {
        $parts = [];

        if ($this->desa) {
            $parts[] = $this->desa->nama;
        }

        if ($this->kecamatan) {
            $parts[] = $this->kecamatan->nama;
        }

        return implode(', ', $parts) ?: '-';
    }

    public function getJumlahFormatAttribute(): string
    {
        return 'Rp '.number_format($this->jumlah, 0, ',', '.');
    }

    public function getTypeLabelAttribute(): string
    {
        return self::TYPE_LABELS[$this->type] ?? $this->type;
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

    public function getSubtypeAttribute(): ?string
    {
        return $this->metadata['jenis'] ?? null;
    }

    public static function generateKode(string $type): string
    {
        $prefix = self::TYPE_PREFIXES[$type] ?? 'TRX';
        $date = now()->format('Ymd');
        $random = strtoupper(substr(md5(uniqid()), 0, 6));

        return "{$prefix}-{$date}-{$random}";
    }
}
