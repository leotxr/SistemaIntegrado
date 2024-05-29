<?php

namespace Modules\HelpDesk\Http\Livewire\Guest;

use Livewire\Component;
use Modules\HelpDesk\Entities\Ticket;
use Modules\HelpDesk\Entities\TicketMessage;
use Modules\HelpDesk\Traits\TicketActions;

class TicketActivity extends Component
{
    use TicketActions;

    public Ticket $showing;

    protected $listeners = [
        'echo:dashboard,TicketUpdated' => '$refresh',
        'refreshParent' => '$refresh'];

    public function mount(Ticket $ticket)
    {
        $this->showing = $ticket;
    }


    public function render()
    {
        return view('helpdesk::livewire.guest.ticket-activity', ['ticket' => $this->showing]);
    }
}
