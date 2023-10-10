<?php

namespace Modules\HelpDesk\Http\Livewire\Tickets;

use Livewire\Component;
use Modules\Helpdesk\Entities\Ticket;
use Modules\HelpDesk\Entities\TicketCategory;
use Modules\HelpDesk\Entities\TicketSubCategory;
use Modules\HelpDesk\Http\Livewire\Dashboard\TicketTabs;
use Modules\HelpDesk\Http\Livewire\Tickets\AllTickets;
use Modules\HelpDesk\Traits\TicketActions;

class TicketDetails extends Component
{

    use TicketActions;

    public $categories;
    public $subcategories;
    public Ticket $ticket;
    public Ticket $editing;
    public $total_ticket;
    public $colors = ['black', '#f97316', '#22c55e', '#eab308', '#3b82f6'];
    public $modalReopen = true;
    public $modalEdit = false;


    protected $listeners = 
    [
        'echo:dashboard,TicketUpdated' => '$refresh',
    ];

    public function mount(Ticket $ticket)
    {
        $this->ticket = $ticket;
        $this->total_ticket = $this->secToTime($ticket->total_ticket);
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
        return view('helpdesk::livewire.tickets.ticket-details');
    }
}
