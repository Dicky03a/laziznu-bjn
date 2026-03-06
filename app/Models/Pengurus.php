<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Pengurus extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pengurus';

    protected $fillable = [
        'nama',
        'gelar_depan',
        'gelar_belakang',
        'jabatan',
        'bidang',
        'urutan',
        'foto',
        'no_hp',
        'email',
        'masa_khidmat_mulai',
        'masa_khidmat_selesai',
        'no_sk',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'urutan' => 'integer',
        'masa_khidmat_mulai' => 'integer',
        'masa_khidmat_selesai' => 'integer',
    ];

    public const JABATAN_LIST = [
        'Ketua',
        'Wakil Ketua',
        'Sekretaris',
        'Wakil Sekretaris',
        'Anggota',
    ];

    public const BIDANG_LIST = [
        'Pengumpulan dan Kerjasama',
        'Penyaluran dan Pemberdayaan',
        'IT dan Marcom',
        'SDM dan Kelembagaan',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopePeriode(Builder $query, int $tahun): Builder
    {
        return $query->where('masa_khidmat_mulai', '<=', $tahun)
            ->where('masa_khidmat_selesai', '>=', $tahun);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('urutan')->orderBy('id');
    }

    public function getNamaLengkapAttribute(): string
    {
        $parts = array_filter([
            $this->gelar_depan,
            $this->nama,
            $this->gelar_belakang,
        ]);

        return implode(' ', $parts);
    }

    public function getJabatanLabelAttribute(): string
    {
        if ($this->jabatan === 'Anggota' && $this->bidang) {
            return "Anggota Bidang {$this->bidang}";
        }

        return $this->jabatan;
    }

    public function getPeriodeAttribute(): string
    {
        return "{$this->masa_khidmat_mulai} - {$this->masa_khidmat_selesai}";
    }

    public function getFotoUrlAttribute(): string
    {
        if ($this->foto && Storage::disk('public')->exists($this->foto)) {
            return Storage::url($this->foto);
        }

        return asset('images/avatar-default.png');
    }
}
