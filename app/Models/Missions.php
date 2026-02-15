<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Missions extends Model
{
    protected $fillable = [
        'profile_id',
        'text',
        'urutan',
    ];

    /**
     * Relasi balik ke profile
     */
    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }
}
