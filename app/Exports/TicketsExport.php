<?php

namespace App\Exports;

use Modules\HelpDesk\Entities\Ticket;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TicketsExport implements FromView
{
    use Exportable;

    public $start;
    public $end;

    public function __construct($range)
    {
        $this->start = $range['initial_date'];
        $this->end = $range['final_date'];
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        return view('helpdesk::dashboard.tables.table-tickets-report', 
        ['tickets' => Ticket::whereBetween('ticket_open', [$this->start, $this->end])->paginate(10)]);
    }
}
