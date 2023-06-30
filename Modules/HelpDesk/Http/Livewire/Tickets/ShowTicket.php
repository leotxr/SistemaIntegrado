<?php

namespace Modules\HelpDesk\Http\Livewire\Tickets;

use Livewire\Component;
use Modules\Helpdesk\Entities\Ticket;

class ShowTicket extends Component
{
    public Ticket $ticket;

    public function render()
    {
        return view('helpdesk::livewire.tickets.show-ticket');
    }
}
