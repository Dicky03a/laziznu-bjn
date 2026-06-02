<?php

namespace App\Observers;

use App\Models\DistributionProgram;
use Illuminate\Support\Facades\Cache;

class DistributionProgramObserver
{
    public function saved(DistributionProgram $program): void
    {
        Cache::forget('public_distribution_programs_active');
    }

    public function deleted(DistributionProgram $program): void
    {
        Cache::forget('public_distribution_programs_active');
    }
}
