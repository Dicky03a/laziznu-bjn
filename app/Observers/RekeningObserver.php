<?php

namespace App\Observers;

use App\Models\Rekening;
use Illuminate\Support\Facades\Cache;

class RekeningObserver
{
    public function saved(Rekening $rekening): void
    {
        Cache::forget('public_rekenings_all');
    }

    public function deleted(Rekening $rekening): void
    {
        Cache::forget('public_rekenings_all');
    }
}
