<?php

namespace Modules\HelpDesk\Http\Livewire\Reports\Tickets;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\HelpDesk\Entities\Ticket;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TicketsExport;
use Modules\HelpDesk\Traits\TicketActions;

class ExtraServicesReport extends Component
{
    use WithPagination;
    use TicketActions;

    public $initial_date;
    public $final_date;


    public function export()
    {
        $range = ['initial_date'=>$this->initial_date,
        'final_date'=>$this->final_date];
        return Excel::download(new TicketsExport($range), 'tickets'.now().'.xlsx');
    }

    public function render()
    {
        return view('helpdesk::livewire.reports.extra-services.extra-services-report',
        ['tickets' => Ticket::whereBetween('ticket_open', [$this->initial_date, $this->final_date])->paginate(10)])
        ->layout('helpdesk::layouts.master')
        ->section('body');
    }
}
