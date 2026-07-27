<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class JobsExpiredAdminNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $expiredCount;

    public function __construct($expiredCount)
    {
        $this->expiredCount = $expiredCount;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Báo cáo: Cập nhật trạng thái tin tuyển dụng hết hạn',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.admin.jobs_expired',
        );
    }
}
