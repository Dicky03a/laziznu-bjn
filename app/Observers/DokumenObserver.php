<?php

namespace App\Observers;

use App\Models\Dokuemen;
use Illuminate\Support\Facades\Cache;

class DokumenObserver
{
    public function saved(Dokuemen $dokumen): void
    {
        Cache::forget('public_dokumens_all');
    }

    public function deleted(Dokuemen $dokumen): void
    {
        Cache::forget('public_dokumens_all');
    }
}
