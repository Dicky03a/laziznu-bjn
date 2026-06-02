<?php

namespace App\Observers;

use App\Models\LaporanTahunan;
use Illuminate\Support\Facades\Cache;

class LaporanTahunanObserver
{
    public function saved(LaporanTahunan $laporan): void
    {
        Cache::forget('public_laporan_tahunan_all');
    }

    public function deleted(LaporanTahunan $laporan): void
    {
        Cache::forget('public_laporan_tahunan_all');
    }
}
