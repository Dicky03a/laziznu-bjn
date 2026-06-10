<?php

namespace App\Observers;

use App\Models\Missions;
use Illuminate\Support\Facades\Cache;

class MissionsObserver
{
    protected function clearCache(): void
    {
        Cache::forget('public_profile_latest');
        Cache::forget('public_profile_full');
    }

    public function created(Missions $missions): void
    {
        $this->clearCache();
    }

    public function updated(Missions $missions): void
    {
        $this->clearCache();
    }

    public function deleted(Missions $missions): void
    {
        $this->clearCache();
    }
}
