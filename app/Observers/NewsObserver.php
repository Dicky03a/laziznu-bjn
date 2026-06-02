<?php

namespace App\Observers;

use App\Models\News;
use Illuminate\Support\Facades\Cache;

class NewsObserver
{
    public function saved(News $news): void
    {
        Cache::forget('public_news_latest_3');
    }

    public function deleted(News $news): void
    {
        Cache::forget('public_news_latest_3');
    }
}
