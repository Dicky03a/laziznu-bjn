<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssistanceRequirement extends Model
{
    protected $fillable = [
        'pillar_id',
        'name',
        'type',
        'is_required',
    ];

    public function pillar()
    {
        return $this->belongsTo(Pillars::class);
    }
}
