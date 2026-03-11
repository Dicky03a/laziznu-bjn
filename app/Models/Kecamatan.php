<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kecamatan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kecamatans';

    protected $fillable = [
        'nama',
        'latitude',
        'longitude',
    ];

    protected $appends = ['jumlah_muzakki', 'jumlah_mustahik'];

    public function desas(): HasMany
    {
        return $this->hasMany(Desa::class);
    }

    public function mustahiks(): HasMany
    {
        return $this->hasMany(Mustahik::class);
    }

    /**
     * Relasi ke Transaction untuk menghitung muzakki
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Accessor: Hitung jumlah muzakki 
     */
    public function getJumlahMuzakkiAttribute(): int
    {
        return $this->transactions()
            ->where('status', 'confirmed')
            ->distinct('nama_donatur')
            ->count('nama_donatur');
    }

    /**
     * Accessor: Hitung jumlah mustahik 
     */
    public function getJumlahMustahikAttribute(): int
    {
        return $this->mustahiks()->count();
    }
}
