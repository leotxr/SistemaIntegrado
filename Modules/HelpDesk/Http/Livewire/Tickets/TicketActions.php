<?php

namespace Modules\HelpDesk\Http\Livewire\Tickets;

use Livewire\Component;
use Modules\HelpDesk\Entities\Ticket;

class TicketActions extends Component
{
    public Ticket $ticket;

    public function mount(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }
    public function callStart(Ticket $ticket)
    {
        $this->emit('TicketStart', $ticket->id);
    }

    public function callEdit(Ticket $ticket)
    {
        $this->emit('TicketEdit', $ticket->id);
    }

    public function callDelete(Ticket $ticket)
    {
        $this->emit('TicketDelete', $ticket->id);
    }

    public function callTransfer(Ticket $ticket)
    {
        $this->emit('TicketTransfer', $ticket->id);
    }

    public function callPause(Ticket $ticket)
    {
        $this->emit('TicketPause', $ticket->id);
    }

    public function callEndPause(Ticket $ticket)
    {
        $this->emit('TicketEndPause', $ticket->id);
    }

    public function callReopen(Ticket $ticket)
    {
        $this->emit('TicketReopen', $ticket->id);
    }

    public function callFinish(Ticket $ticket)
    {
        $this->emit('TicketFinish', $ticket->id);
    }

    public function render()
    {
        return view('helpdesk::livewire.tickets.ticket-actions');
    }
}
