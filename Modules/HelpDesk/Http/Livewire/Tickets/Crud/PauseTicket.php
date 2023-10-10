<?php

namespace Modules\HelpDesk\Http\Livewire\Tickets\Crud;

use Livewire\Component;
use Modules\HelpDesk\Entities\Ticket;
use Modules\HelpDesk\Entities\TicketMessage;
use Modules\HelpDesk\Entities\TicketPause;
use Illuminate\Support\Facades\Auth;
use App\Events\TicketUpdated;
use DateTime;
use Modules\HelpDesk\Traits\TicketActions;

class PauseTicket extends Component
{

    use TicketActions;

    public $modalTicket = true;
    public $modalPause = false;
    public $message;
    public Ticket $pausing;


    protected $listeners = [
        'TicketPause' => 'openPauseTicket',
        'TicketEndPause' => 'endPause',
        'echo:dashboard,TicketUpdated' => '$refresh',
    ];

    public function openPauseTicket(Ticket $ticket)
    {
        $this->modalPause = true;
        $this->pausing = $ticket;
    }

    public function pause()
    {

        $message = $this->saveMessage($this->pausing, $this->message);
        if ($this->createPause($this->pausing, $message)) {
            $this->modalPause = false;
            $this->modalTicket = false;
            $this->message = '';

            TicketUpdated::dispatch();
        } else {
            $this->dispatchBrowserEvent(
                'notify',
                ['type' => 'error', 'message' => 'Ocorreu um erro ao pausar o chamado.']
            );
        }
    }

    public function endPause(Ticket $ticket)
    {

        if ($this->finishPause($ticket)) {

            $this->modalPause = false;
            $this->modalTicket = false;
            $this->dispatchBrowserEvent(
                'notify',
                ['type' => 'success', 'message' => 'Status alterado para em atendimento!']
            );
        } else {
            $this->dispatchBrowserEvent(
                'notify',
                ['type' => 'error', 'message' => 'Ocorreu um erro ao finalizar a pausa.']
            );
        }
        TicketUpdated::dispatch();
    }


    public function render()
    {
        return view('helpdesk::livewire.tickets.crud.pause-ticket');
    }
}
