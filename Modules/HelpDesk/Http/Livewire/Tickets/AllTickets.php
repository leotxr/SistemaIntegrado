<?php

namespace Modules\HelpDesk\Http\Livewire\Tickets;

use Livewire\Component;

class AllTickets extends Component
{
    public function render()
    {
        return view('helpdesk::livewire.tickets.all-tickets');
    }
}
