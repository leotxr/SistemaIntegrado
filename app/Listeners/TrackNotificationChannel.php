<?php

namespace App\Listeners;

use App\Support\NotificationFailureContext;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Events\NotificationSending;

class TrackNotificationChannel
{
    public function __construct(private NotificationFailureContext $failureContext)
    {
    }

    public function handle(NotificationSending $event): void
    {
        $notifiable = $event->notifiable;

        $this->failureContext->set([
            'channel' => $event->channel,
            'notification_type' => get_class($event->notification),
            'notifiable_type' => $notifiable instanceof Model
                ? $notifiable->getMorphClass()
                : get_class($notifiable),
            'notifiable_id' => $notifiable instanceof Model && $notifiable->getKey() !== null
                ? (string) $notifiable->getKey()
                : null,
        ]);
    }
}
