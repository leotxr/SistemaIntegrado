<?php

namespace Modules\Triagem\Exports;

use Modules\Triagem\Entities\Term;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromQuery;
use Modules\HelpDesk\Traits\TicketActions;

class ExamByDateExport implements FromQuery
{
    use Exportable;
    use TicketActions;

    public $start;
    public $end;
    public $nurses;
    public $sectors;

    public function __construct($range)
    {
        $this->start    = $range['start_date'];
        $this->end      = $range['end_date'];
        $this->nurses   = $range['nurses'];
        $this->sectors  = $range['sectors'];
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function query()
    {
        $data = [
            'startDate' => $this->start,
            'endDate'   => $this->end,
            'nurses'    => $this->nurses,
            'sectors'   => $this->sectors
        ];


        return Term::getTermsByDate($data, 'export');
    }
}
