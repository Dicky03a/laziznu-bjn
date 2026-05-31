<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssistanceRequest extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'ticket_number',
        'pillar_id',
        'nik',
        'name',
        'phone',
        'address',
        'description',
        'status',
        'admin_notes',
    ];

    public function pillar()
    {
        return $this->belongsTo(Pillars::class);
    }

    public function attachments()
    {
        return $this->hasMany(AssistanceAttachment::class);
    }
}
