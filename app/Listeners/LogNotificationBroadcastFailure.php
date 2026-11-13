<?php

namespace App\Listeners;

use Illuminate\Broadcasting\BroadcastEvent;
use Illuminate\Notifications\SendQueuedNotifications;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Support\Facades\DB;
use App\Support\NotificationFailureContext;

class LogNotificationBroadcastFailure
{
    public function __construct(private NotificationFailureContext $failureContext)
    {
    }

    public function handle(JobFailed $event): void
    {
        try {
            $payload = $event->job->payload();
            $data = $payload['data'] ?? null;
            $commandName = is_array($data) ? ($data['commandName'] ?? null) : null;
            $jobName = $event->job->resolveName();
            $trackedJobs = [
                BroadcastEvent::class,
                SendQueuedNotifications::class,
            ];

            if (!in_array($commandName, $trackedJobs, true) && !in_array($jobName, $trackedJobs, true)) {
                return;
            }

            $jobName = $commandName ?: $jobName;
            $channelContext = $jobName === SendQueuedNotifications::class
                ? $this->failureContext->current()
                : null;
            $channel = $channelContext['channel'] ?? null;
            $failureStage = $this->failureStage($jobName, $channel);
            $broadcastDriver = in_array($failureStage, ['broadcast_delivery', 'notification_broadcast_dispatch'], true)
                ? config('broadcasting.default')
                : null;

            DB::table('log_notification_errors')->insert([
                'job_id' => $event->job->getJobId(),
                'connection' => $event->connectionName,
                'queue' => $event->job->getQueue(),
                'job_name' => $jobName,
                'failure_stage' => $failureStage,
                'channel' => $channel,
                'notification_type' => $channelContext['notification_type'] ?? null,
                'notifiable_type' => $channelContext['notifiable_type'] ?? null,
                'notifiable_id' => $channelContext['notifiable_id'] ?? null,
                'exception_type' => get_class($event->exception),
                'exception_message' => $event->exception->getMessage(),
                'exception_file' => $event->exception->getFile(),
                'exception_line' => $event->exception->getLine(),
                'exception_trace' => $event->exception->getTraceAsString(),
                'context' => json_encode([
                    'display_name' => $payload['displayName'] ?? null,
                    'attempts' => $event->job->attempts(),
                    'broadcast_driver' => $broadcastDriver,
                ], JSON_THROW_ON_ERROR),
                'failed_at' => now(),
            ]);
        } finally {
            $this->failureContext->clear();
        }
    }

    private function failureStage(string $jobName, ?string $channel): string
    {
        if ($jobName === BroadcastEvent::class) {
            return 'broadcast_delivery';
        }

        if ($channel === 'broadcast') {
            return 'notification_broadcast_dispatch';
        }

        return $channel === null ? 'notification_job' : 'notification_channel';
    }
}
