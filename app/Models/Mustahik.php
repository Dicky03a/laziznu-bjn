<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mustahik extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nik',
        'jenis_kelamin',
        'kecamatan_id',
        'desa_id',
        'no_hp',
        'kategori_asnaf',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relasi ke Kecamatan
     */
    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    /**
     * Relasi ke Desa
     */
    public function desa()
    {
        return $this->belongsTo(Desa::class);
    }

    /**
     * Scope untuk filter status aktif
     */
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    /**
     * Scope untuk filter by kategori
     */
    public function scopeByKategori($query, $kategori)
    {
        return $query->where('kategori_asnaf', $kategori);
    }

    /**
     * Accessor untuk format kategori asnaf
     */
    public function getKategoriAsnafFormatted()
    {
        $kategoris = [
            'fakir' => 'Fakir',
            'miskin' => 'Miskin',
            'amil' => 'Amil',
            'muallaf' => 'Muallaf',
            'riqab' => 'Riqab',
            'gharim' => 'Gharim',
            'fisabilillah' => 'Fisabilillah',
            'ibnu_sabil' => 'Ibnu Sabil',
        ];

        return $kategoris[$this->kategori_asnaf] ?? $this->kategori_asnaf;
    }

    /**
     * Accessor untuk format jenis kelamin
     */
    public function getJenisKelaminFormatted()
    {
        return ucfirst($this->jenis_kelamin);
    }

    /**
     * Accessor untuk format status
     */
    public function getStatusFormatted()
    {
        return ucfirst($this->status) === 'Aktif' ? 'Aktif' : 'Nonaktif';
    }
}
