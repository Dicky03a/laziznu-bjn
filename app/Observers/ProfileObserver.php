<?php

namespace App\Observers;

use App\Models\Profile;
use Illuminate\Support\Facades\Cache;

class ProfileObserver
{
    public function saved(Profile $profile): void
    {
        Cache::forget('public_profile_latest');
        Cache::forget('public_profile_full');
    }

    public function deleted(Profile $profile): void
    {
        Cache::forget('public_profile_latest');
        Cache::forget('public_profile_full');
    }
}
