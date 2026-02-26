<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QurbanPaymentConfirmation extends Model
{
    use HasFactory;

    protected $table = 'qurban_payment_confirmations';

    protected $fillable = [
        'registration_id',
        'nama_pengirim',
        'bank_pengirim',
        'nomor_rekening_pengirim',
        'jumlah_transfer',
        'tanggal_transfer',
        'bukti_transfer',
        'catatan',
    ];

    protected $casts = [
        'jumlah_transfer' => 'integer',
        'tanggal_transfer' => 'date',
    ];

    public function registration(): BelongsTo
    {
        return $this->belongsTo(QurbanRegistration::class, 'registration_id');
    }

    public function getBuktiUrlAttribute(): ?string
    {
        return $this->bukti_transfer
            ? asset('storage/' . $this->bukti_transfer)
            : null;
    }

    public function getJumlahFormatAttribute(): string
    {
        return 'Rp ' . number_format($this->jumlah_transfer, 0, ',', '.');
    }
}
