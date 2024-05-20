<?php

namespace Modules\HelpDesk\Http\Livewire\Guest;

use Livewire\Component;
use Modules\HelpDesk\Entities\Ticket;

class TicketDetails extends Component
{
    public Ticket $ticket;

    public function mount(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }
    public function render()
    {
        return view('helpdesk::livewire.guest.ticket-details');
    }
}
