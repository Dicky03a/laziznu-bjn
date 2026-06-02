<?php

namespace App\Observers;

use App\Models\Program;
use Illuminate\Support\Facades\Cache;

class ProgramObserver
{
    public function saved(Program $program): void
    {
        $this->clearCache();
    }

    public function deleted(Program $program): void
    {
        $this->clearCache();
    }

    private function clearCache(): void
    {
        Cache::forget('public_programs_latest_3');
        Cache::forget('public_program_unggulan');
        Cache::forget('public_programs_donasi');
    }
}
