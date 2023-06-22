<?php

namespace Modules\HelpDesk\Http\Livewire\Tickets;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\HelpDesk\Entities\Ticket;

class AllTickets extends Component
{
    use WithPagination;

    public $sortField = 'tickets.id';
    public $sortDirection = 'desc';
    public $search = '';

    public function sortBy($field)
    {

        $this->sortDirection = $this->sortField === $field
            ? $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc'
            : 'asc';

        $this->sortField = $field;
    }

    public function render()
    {
        return view('helpdesk::livewire.tickets.all-tickets',
    [
        'tickets' => Ticket::search($this->sortField, $this->search)->orderBy($this->sortField, $this->sortDirection)->paginate(10)
    ]);
    }
}
