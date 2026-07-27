<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\JobPost;
use App\Mail\JobsExpiredAdminNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class ExpireJobsCommand extends Command
{
    protected $signature = 'jobs:expire';

    protected $description = 'Cập nhật trạng thái tin tuyển dụng hết hạn thành Expired và gửi báo cáo cho Admin';

    public function handle()
    {
        $now = Carbon::now();

        $jobsQuery = JobPost::where('expired_at', '<', $now)
            ->where('status', '!=', 'expired');

        $expiredCount = $jobsQuery->count();

        if ($expiredCount > 0) {
            $jobsQuery->update(['status' => 'expired']);

            $adminEmail = env('ADMIN_EMAIL', 'admin@example.com');
            Mail::to($adminEmail)->send(new JobsExpiredAdminNotification($expiredCount));

            $this->info("Đã cập nhật {$expiredCount} tin tuyển dụng và gửi email báo cáo.");

            Log::info("jobs:expire command - Đã cập nhật {$expiredCount} tin tuyển dụng và gửi email.");
        } else {
            $this->info('Không có tin tuyển dụng nào cần cập nhật.');
        }

        return Command::SUCCESS;
    }
}
