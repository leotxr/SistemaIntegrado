<?php

namespace Modules\HelpDesk\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\User;
use Modules\HelpDesk\Entities\Ticket;

class NotifyTicketFinished extends Notification implements ShouldQueue
{
    use Queueable;

    public $user;
    public $ticket;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, Ticket $ticket)
    {
        $this->user = $user;
        $this->ticket = $ticket;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
        ->from('informatica@ultrimagemuba.com.br', 'HelpDesk - Sigma Ultrimagem')
        ->subject('Chamado Finalizado - #' . $this->ticket->id . " - " . $this->ticket->title)
        ->greeting('Chamado Finalizado.')
        ->line('Assunto: ' . $this->ticket->title)
        ->line('Descrição: ' . $this->ticket->description)
        ->line('Chamado aberto por: ' . $this->user->name)
        ->salutation('Sigma - Ultrimagem');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
