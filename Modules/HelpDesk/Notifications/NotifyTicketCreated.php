<?php

namespace Modules\HelpDesk\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use App\Models\User;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Modules\HelpDesk\Entities\Ticket;

class NotifyTicketCreated extends Notification implements ShouldQueue, ShouldBroadcast
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
        return ['broadcast','database', 'mail'];
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
            ->subject('Novo Chamado - #' . $this->ticket->id . " - " . $this->ticket->title)
            ->greeting('Novo Chamado.')
            ->line('Assunto: ' . $this->ticket->title)
            ->line('Descrição: ' . $this->ticket->description)
            ->action('Acessar Chamado', 'http://192.168.254.182:81/helpdesk/painel/chamados/' . $this->ticket->id . '/detalhes')
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
            'ticket_id' => $this->ticket->id,
            'ticket_title' => $this->ticket->title,
            'user_id' => $this->user->id,
            'user_name' => $this->user->name,
        ];
    }

    public function toBroadcast($notifiable)
    {

        return new BroadcastMessage([
            'ticket_id' => $this->ticket->id,
            'ticket_title' => $this->ticket->title,
            'user_id' => $this->user->id,
            'user_name' => $this->user->name,
        ]);
    }
}
