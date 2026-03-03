<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Profile extends Model
{
    protected $fillable = [
        'title',
        'deskripsi',
        'tahun_berdiri',
        'penerima_manfaat',
        'program_tersalurkan',
        'visi',
    ];

    public function missions(): HasMany
    {
        return $this->hasMany(Missions::class)->orderBy('urutan');
    }

    public function pillars(): HasMany
    {
        return $this->hasMany(Pillars::class)->orderBy('urutan');
    }
}
