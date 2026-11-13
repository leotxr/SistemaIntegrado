<?php

namespace App\Listeners;

use App\Support\NotificationFailureContext;
use Illuminate\Queue\Events\JobProcessing;

class ResetNotificationFailureContext
{
    public function __construct(private NotificationFailureContext $failureContext)
    {
    }

    public function handle(JobProcessing $event): void
    {
        $this->failureContext->clear();
    }
}
