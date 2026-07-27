<?php

namespace App\Observers;

use App\Models\JobPost;
use Illuminate\Support\Facades\Cache;

class JobPostObserver
{
    public function updated(JobPost $jobPost): void
    {
        Cache::forget("job:{$jobPost->id}");
    }

    public function deleted(JobPost $jobPost): void
    {
        Cache::forget("job:{$jobPost->id}");
    }
}
