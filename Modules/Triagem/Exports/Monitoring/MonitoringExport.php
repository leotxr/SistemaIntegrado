<?php

namespace Modules\Triagem\Exports\Monitoring;

use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Modules\Triagem\Entities\Term;
use Modules\Triagem\Traits\WorkListQueries;


class MonitoringExport implements FromView
{
    use Exportable;
    use WorkListQueries;

    public $date;
    public $sectors;


    public function __construct($range)
    {
        $this->date = $range['date'];
        $this->sectors = $range['sectors'];
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {

        return view('triagem::XLS.monitoring-export', ['pacientes' =>
            $this->getMonitoringData($this->sectors, $this->date)->paginate(10), 'triagens' => Term::whereDate('exam_date', $this->date)->get(),]);
    }
}
