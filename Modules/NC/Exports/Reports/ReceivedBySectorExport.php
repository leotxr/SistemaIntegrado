<?php

namespace Modules\NC\Exports\Reports;

use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Modules\NC\Entities\NonConformity;

class ReceivedBySectorExport implements FromView
{
    use Exportable;

    public $start;
    public $end;
    public $group;


    public function __construct($range)
    {
        $this->start = $range['start_date'];
        $this->end = $range['end_date'];
        $this->group = $range['group'];
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {

        return view('nc::livewire.utils.table-export', ['ncs' => $this->group->groupNonConformities->whereBetween('n_c_date', [$this->start, $this->end])]);
    }
}
