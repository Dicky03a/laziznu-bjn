<?php

namespace App\Observers;

use App\Models\Pengurus;
use Illuminate\Support\Facades\Cache;

class PengurusObserver
{
    public function saved(Pengurus $pengurus): void
    {
        $this->clearCache();
    }

    public function deleted(Pengurus $pengurus): void
    {
        $this->clearCache();
    }

    private function clearCache(): void
    {
        Cache::forget('public_pengurus_periode_aktif');
        Cache::forget('public_pengurus_by_jabatan');
        Cache::forget('public_pengurus_no_sk');
    }
}
