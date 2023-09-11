<?php

namespace Modules\Orcamento\Listeners;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\User;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Modules\Orcamento\Entities\Budget;

class NotifyBudgetUpdated extends Notification implements ShouldQueue, ShouldBroadcast
{
    use Queueable;
    public $user;
    public $budget;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(User $user, Budget $budget)
    {
        $this->user = $user;
        $this->budget = $budget;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['broadcast'];
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        //
    }

    public function toBroadcast($notifiable)
    {

        return new BroadcastMessage([
            'budget_id' => $this->budget->id,
            'user_id' => $this->user->id,
            'user_name' => $this->user->name,
        ]);
    }
}
