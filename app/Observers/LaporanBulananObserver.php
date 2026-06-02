<?php

namespace App\Observers;

use App\Models\LaporanBulanan;
use Illuminate\Support\Facades\Cache;

class LaporanBulananObserver
{
    public function saved(LaporanBulanan $laporan): void
    {
        Cache::forget('public_laporan_bulanan_all');
    }

    public function deleted(LaporanBulanan $laporan): void
    {
        Cache::forget('public_laporan_bulanan_all');
    }
}
