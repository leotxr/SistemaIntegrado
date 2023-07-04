<?php

namespace Modules\HelpDesk\Http\Livewire\Tickets;

use Livewire\Component;
use Modules\Helpdesk\Entities\Ticket;
use Modules\HelpDesk\Http\Livewire\Dashboard\TicketTabs;
use Modules\HelpDesk\Http\Livewire\Tickets\AllTickets;

class ShowTicket extends Component
{
    public Ticket $ticket;
    public $colors = ['black', '#f97316', '#22c55e', '#eab308', '#3b82f6'];
    public $modalReopen = true;


    public function confirmReopen(Ticket $ticket)
    {
        
    }
    public function render()
    {
        return view('helpdesk::livewire.tickets.show-ticket');
    }
}
