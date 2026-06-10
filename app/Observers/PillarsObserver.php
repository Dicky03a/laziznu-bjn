<?php

namespace App\Observers;

use App\Models\Pillars;
use Illuminate\Support\Facades\Cache;

class PillarsObserver
{
    protected function clearCache(): void
    {
        Cache::forget('public_profile_latest');
        Cache::forget('public_profile_full');
    }

    public function created(Pillars $pillars): void
    {
        $this->clearCache();
    }

    public function updated(Pillars $pillars): void
    {
        $this->clearCache();
    }

    public function deleted(Pillars $pillars): void
    {
        $this->clearCache();
    }
}
