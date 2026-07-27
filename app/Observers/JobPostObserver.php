<?php

namespace App\Observers;

use App\Models\JobPost;
use App\Mail\JobPostChangedNotification;
use Illuminate\Support\Facades\Mail;

class JobPostObserver
{
    protected $adminEmail;

    public function __construct()
    {
        $this->adminEmail = env('ADMIN_EMAIL', 'admin@example.com');
    }

    public function updated(JobPost $jobPost): void
    {
        if (
            $jobPost->isDirty('status') &&
            $jobPost->getOriginal('status') === 'published' &&
            $jobPost->status === 'expired'
        ) {
            Mail::to($this->adminEmail)->send(new JobPostChangedNotification('Đã hết hạn', $jobPost->title));
        }
    }
}
