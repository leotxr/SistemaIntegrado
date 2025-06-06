<?php

namespace App\Exports;

use Modules\HelpDesk\Entities\Ticket;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromQuery;
use Modules\HelpDesk\Traits\TicketActions;

class TicketsExport implements FromQuery
{
    use Exportable;
    use TicketActions;

    public $start;
    public $end;

    public function __construct($range)
    {
        $this->start = $range['start_date'];
        $this->end = $range['end_date'];
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function query()
    {
        $data = ['start_date' => $this->start, 'end_date' => $this->end];
        

        return Ticket::getTicketsByDate($data, 'export');
    }
}
