<?php

namespace Modules\HelpDesk\Http\Livewire\Dashboard;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\HelpDesk\Entities\TicketPriority;
use Modules\HelpDesk\Entities\TicketStatus;
use Modules\HelpDesk\Entities\Ticket;

class TicketTabs extends Component
{
    use WithPagination;

    public $activeStatus = 1;

    public function selectStatus($id)
    {
        $status = TicketStatus::find($id);
        $this->activeStatus = $status->id;
    }
    public function render()
    {
        return view('helpdesk::livewire.dashboard.ticket-tabs', [
            'priorities' => TicketPriority::orderBy('order', 'desc')->get(),
            'statuses' => TicketStatus::orderBy('order', 'asc')->get(),
        'tickets' => Ticket::join('ticket_categories', 'tickets.category_id', '=', 'ticket_categories.id')
        ->join('ticket_priorities', 'ticket_categories.priority_id', '=', 'ticket_priorities.id')
        ->where('tickets.status_id', $this->activeStatus)
        ->select('tickets.id', 'tickets.title', 'tickets.category_id', 'tickets.created_at', 'tickets.requester_id')
        ->orderBy('ticket_priorities.order', 'desc')
        ->paginate(7)]);
    }
}
