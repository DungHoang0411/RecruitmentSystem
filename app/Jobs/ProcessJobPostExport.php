<?php

namespace App\Jobs;

use App\Models\ExportLog;
use App\Exports\JobPostsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessJobPostExport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $logId;
    protected $filters;

    public function __construct($logId, $filters)
    {
        $this->logId = $logId;
        $this->filters = $filters;
    }

    public function handle(): void
    {
        $log = ExportLog::find($this->logId);

        if (!$log) {
            return;
        }

        try {
            $log->update(['status' => 'processing']);

            $fileName = 'job_posts_export_' . time() . '.xlsx';

            Excel::store(new JobPostsExport($this->filters), 'exports/' . $fileName, 'public');

            $log->update([
                'status' => 'completed',
                'file_name' => $fileName
            ]);

        } catch (\Throwable $e) {
            $log->update([
                'status' => 'failed',
                'error_message' => $e->getMessage() . ' ở dòng ' . $e->getLine()
            ]);
        }
    }
}
