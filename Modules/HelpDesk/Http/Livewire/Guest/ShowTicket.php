<?php

namespace Modules\HelpDesk\Http\Livewire\Guest;

use Livewire\Component;
use Modules\HelpDesk\Entities\Ticket;

class ShowTicket extends Component
{
    public Ticket $ticket;
    public $colors = ['black', '#f97316', '#22c55e', '#eab308', '#3b82f6'];

    public function mount(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }
    public function render()
    {
        return view('helpdesk::livewire.guest.show-ticket');
    }
}
