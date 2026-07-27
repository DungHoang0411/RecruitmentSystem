<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Models\Job;
use App\Observers\JobObserver;

class EventServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Job::observe(JobObserver::class);
    }
}
