<?php

namespace App\Listeners;

use App\Events\CandidateRegistered;
use App\Mail\WelcomeCandidateMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendWelcomeActivationMail implements ShouldQueue
{
    public function handle(CandidateRegistered $event): void
    {
        Mail::to($event->user->email)->send(new WelcomeCandidateMail($event->user, $event->token));
    }
}
