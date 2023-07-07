<?php

namespace Modules\HelpDesk\Http\Livewire\Tickets;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\HelpDesk\Entities\Ticket;
use DateTime;
use Modules\HelpDesk\Http\Livewire\Dashboard\TicketTabs;
use Illuminate\Support\Facades\Auth;
use Modules\HelpDesk\Entities\TicketPause;
use App\Events\TicketCreated;

class AllTickets extends Component
{
    use WithPagination;

    public $sortField = 'tickets.id';
    public $sortDirection = 'desc';
    public $search = '';
    public Ticket $showing;
    public $modalTicket = false;
    public $total;
    public Ticket $reopening;
    public $modalReopen = false;
    public $message = '';

    public function sortBy($field)
    {

        $this->sortDirection = $this->sortField === $field
            ? $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc'
            : 'asc';

        $this->sortField = $field;
    }

    public $colors = ['black', '#f97316', '#22c55e', '#eab308', '#3b82f6'];

    public function callShow(Ticket $ticket)
    {
         $this->emit('TicketShow', $ticket->id);
    }


    public function render()
    {
        return view(
            'helpdesk::livewire.tickets.all-tickets',
            [
                'tickets' => Ticket::whereNotNull('ticket_close')->search($this->sortField, $this->search)->orderBy($this->sortField, $this->sortDirection)->paginate(10)
            ]
        );
    }
}
