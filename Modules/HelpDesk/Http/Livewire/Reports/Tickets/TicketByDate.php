<?php

namespace Modules\HelpDesk\Http\Livewire\Reports\Tickets;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\HelpDesk\Entities\Ticket;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TicketsExport;
use Modules\HelpDesk\Traits\TicketActions;

class TicketByDate extends Component
{
    use WithPagination;
    use TicketActions;

    public $initial_date;
    public $final_date;
    private $ticketModel;

    public $tickets;

    public function mount() {}


    public function export()
    {
        $range = ['start_date'=>$this->initial_date,
        'end_date'=>$this->final_date];

        return Excel::download(new TicketsExport($range), 'tickets'.now().'.xlsx');
    }

    public function search()
    {
        $this->render();
    }

    private function searchTickets()
    {
        $data = ['start_date' => $this->initial_date, 'end_date' => $this->final_date];
        $this->ticketModel = new Ticket();

        $this->tickets = $this->ticketModel->getTicketsByDate($data);
        
    }

    public function render()
    {
        return view(
            'helpdesk::livewire.reports.tickets.ticket-by-date',
            ['tickets' => $this->tickets ? $this->tickets->paginate(10) : array()]
        )
            ->layout('helpdesk::layouts.master')
            ->section('body');
    }
}
