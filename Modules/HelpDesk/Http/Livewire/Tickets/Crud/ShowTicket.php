<?php

namespace Modules\HelpDesk\Http\Livewire\Tickets\Crud;

use Livewire\Component;
use Modules\HelpDesk\Entities\Ticket;
use DateTime;
use App\Events\TicketUpdated;
use Modules\HelpDesk\Traits\TicketActions;

class ShowTicket extends Component
{

    use TicketActions;

    public Ticket $showing;
    public Ticket $editing;
    public $modalTicket = false;
    public $modalEdit = false;
    public $total;
    public $message;


    public $colors = ['black', '#f97316', '#22c55e', '#eab308', '#3b82f6'];

    protected $listeners = [
        'TicketShow' => 'show',
        'echo:dashboard,TicketUpdated' => '$refresh',
    ];


    public function callStart(Ticket $ticket)
    {
        $this->emit('TicketStart', $ticket->id);
        $this->modalTicket = false;
    }

    public function callEdit(Ticket $ticket)
    {
        $this->emit('TicketEdit', $ticket->id);
        $this->modalEdit = false;
    }

    public function callFinish(Ticket $ticket)
    {
        $this->emit('TicketFinish', $ticket->id);
    }

    public function callPause(Ticket $ticket)
    {
        $this->emit('TicketPause', $ticket->id);
    }

    public function callDelete(Ticket $ticket)
    {
        $this->emit('TicketDelete', $ticket->id);
    }

    public function sendMessage(Ticket $ticket)
    {
        $this->saveMessage($ticket, $this->message);
    }


    public function show(Ticket $ticket)
    {
        $this->modalTicket = true;
        $this->showing = $ticket;

        if (isset($this->showing->ticket_close)) {
            $diff_atendimento = abs(strtotime($this->showing->ticket_close) - strtotime($this->showing->ticket_start));
            isset($this->showing->total_pause) ? $this->total = abs($diff_atendimento - $this->showing->total_pause) : $this->total = $diff_atendimento;
            $this->total = $this->secToTime($this->total);
        }



        /*
        if (isset($this->showing->ticket_close)) {
            $inicio_atendimento = new DateTime($this->showing->ticket_start);
            $fim_atendimento = new DateTime($this->showing->ticket_close);
            $diff_atendimento = $inicio_atendimento->diff($fim_atendimento);
            $tempo_atendimento = $diff_atendimento->format("%H:%I:%S");

            $tempo_pausa = date('H:i:s', $this->showing->total_pause);
            $atendimento = date('H:i:s', $tempo_atendimento);
            $diff_pause = $atendimento->diff($tempo_pausa);
            $tempo_total = $diff_pause->format("%H:%I:%S");


            isset($this->showing->total_pause) ? $this->total = $tempo_total : $this->total = $tempo_atendimento;
        }
        */
    }



    public function render()
    {
        return view('helpdesk::livewire.tickets.crud.show-ticket');
    }
}
