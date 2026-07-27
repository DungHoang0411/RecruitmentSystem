<?php

namespace App\Observers;

use App\Models\Job;
use Illuminate\Support\Facades\Cache;

class JobObserver
{
    public function updated(Job $job): void
    {
        Cache::forget("job:{$job->id}");
    }

    public function deleted(Job $job): void
    {
        Cache::forget("job:{$job->id}");
    }
}
