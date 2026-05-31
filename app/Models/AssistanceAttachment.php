<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssistanceAttachment extends Model
{
    protected $fillable = [
        'assistance_request_id',
        'assistance_requirement_id',
        'value',
    ];

    public function request()
    {
        return $this->belongsTo(AssistanceRequest::class, 'assistance_request_id');
    }

    public function requirement()
    {
        return $this->belongsTo(AssistanceRequirement::class, 'assistance_requirement_id');
    }
}
