<?php

namespace Modules\HelpDesk\Http\Livewire\Reports\Tickets;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\HelpDesk\Entities\Ticket;

class TicketByDate extends Component
{
    use WithPagination;

    public $initial_date;
    public $final_date;

    public function render()
    {
        return view('helpdesk::livewire.reports.tickets.ticket-by-date', 
        ['tickets' => Ticket::whereBetween('ticket_open', [$this->initial_date, $this->final_date])->paginate(10)])
        ->layout('helpdesk::layouts.master')
        ->section('body');
    }
}
