<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Notifications\Events\NotificationSending;
use Illuminate\Notifications\Events\NotificationSent;
use App\Listeners\LogNotificationBroadcastFailure;
use App\Listeners\ClearNotificationChannel;
use App\Listeners\ResetNotificationFailureContext;
use App\Listeners\TrackNotificationChannel;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        JobFailed::class => [
            LogNotificationBroadcastFailure::class,
        ],
        JobProcessing::class => [
            ResetNotificationFailureContext::class,
        ],
        NotificationSending::class => [
            TrackNotificationChannel::class,
        ],
        NotificationSent::class => [
            ClearNotificationChannel::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
