<?php

namespace Modules\HelpDesk\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Modules\HelpDesk\Entities\ExtraService;

class NotifyExtraServiceCreated extends Notification implements ShouldQueue, ShouldBroadcast
{
    use Queueable;

    public $extra_service;
    public $user;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, ExtraService $extra_service)
    {
        $this->extra_service = $extra_service;
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['broadcast', 'database', 'mail'];
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
            ->from('sigma@ultrimagemuba.com.br', 'Serviços Extras - Sigma Ultrimagem')
            ->subject('Nova Solicitação - #' . $this->extra_service->id . " - " . $this->extra_service->title)
            ->greeting('Nova Solicitação de Serviços Extras.')
            ->line('Assunto: ' . $this->extra_service->title)
            ->line('Descrição: ' . $this->extra_service->description)
            //->action('Acessar Chamado', 'http://192.168.254.182:81/helpdesk/painel/chamados/' . $this->extra_service->id . '/detalhes')
            ->line('Solicitação aberta por: ' . $this->user->name)
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
