<?php

namespace App\Observers;

use App\Models\LaporanMwc;
use Illuminate\Support\Facades\Cache;

class LaporanMwcObserver
{
    public function saved(LaporanMwc $laporan): void
    {
        Cache::forget('public_laporan_mwc_all');
    }

    public function deleted(LaporanMwc $laporan): void
    {
        Cache::forget('public_laporan_mwc_all');
    }
}
