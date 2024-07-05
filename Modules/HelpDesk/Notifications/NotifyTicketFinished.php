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
    public $atendente;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, Ticket $ticket)
    {
        $this->user = $user;
        $this->ticket = $ticket;
        $this->atendente = $ticket->find($ticket->id)->TicketUser;
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
        ->from('sigma@ultrimagemuba.com.br', 'HelpDesk - Sigma Ultrimagem')
        ->subject('Chamado Finalizado - #' . $this->ticket->id . " - " . $this->ticket->title)
        ->greeting('Olá ' . $this->user->name . '!')
        ->line('Seu Chamado - ' . $this->ticket->title)
        ->line('Foi finalizado pelo atendente: ' . $this->atendente->name )
        ->action('Acessar Chamado', 'http://192.168.254.182:81/helpdesk/chamados/' . $this->ticket->id)
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
