<?php

namespace App\Listeners;

use App\Models\AuditLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LoginAuditLogListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        AuditLog::create([
            'user_id' => $event->user->id,
            'action' => 'login',
        ]);
    }
}
