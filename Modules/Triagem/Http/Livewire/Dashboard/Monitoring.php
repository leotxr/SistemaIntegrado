<?php

namespace Modules\Triagem\Http\Livewire\Dashboard;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Triagem\Entities\Term;
use Livewire\WithPagination;
use Modules\Triagem\Entities\Sector;
use Modules\Triagem\Exports\Monitoring\MonitoringExport;
use Modules\Triagem\Traits\WorkListQueries;

class Monitoring extends Component
{
    use WithPagination;
    use WorkListQueries;

    public $date;
    public $modalTriagem = false;
    public $sectors;
    public $sec = [14, 31];
    public $showing;

    public function mount()
    {
        $this->date = date('Y-m-d');
        $this->sectors = Sector::all();
    }

    public function showTriagem($patient_id)
    {
        $this->modalTriagem = true;
        $this->showing = Term::where('patient_id', $patient_id)->first();


    }

    public function export()
    {
        $range = [
            'date' => $this->date,
            'sectors' => $this->sec,
        ];
        return Excel::download(new MonitoringExport($range), 'monitoramento-triagem-' . $this->date . '.xlsx');
    }


    public function render()
    {

        return view('triagem::livewire.dashboard.monitoring', ['pacientes' =>
        $this->getMonitoringData($this->sec, $this->date)->paginate(10), 'triagens' => Term::whereDate('exam_date', $this->date)->get(), ]);
    }
}
