<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CandidateRegistered
{
    use Dispatchable, SerializesModels;

    public $user;
    public $token;

    public function __construct($user, $token)
    {
        $this->user = $user;
        $this->token = $token;
    }
}
