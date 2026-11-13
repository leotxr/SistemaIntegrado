<?php

namespace App\Listeners;

use App\Support\NotificationFailureContext;
use Illuminate\Notifications\Events\NotificationSent;

class ClearNotificationChannel
{
    public function __construct(private NotificationFailureContext $failureContext)
    {
    }

    public function handle(NotificationSent $event): void
    {
        $context = $this->failureContext->current();

        if (
            $context !== null
            && $context['channel'] === $event->channel
            && $context['notification_type'] === get_class($event->notification)
        ) {
            $this->failureContext->clear();
        }
    }
}
