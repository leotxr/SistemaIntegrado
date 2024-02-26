<?php

namespace Modules\Recepcao\Http\Livewire\Schedules;

use Livewire\Component;

class ShowReports extends Component
{
    public $report = '';
    public $patient_id = '';
    public $patient_name = '';
    public $exam_date = '';
    public $doctor = '';
    public $user = '';
    public $modalReport = false;

    protected $listeners = [
        'showReport'
    ];

    public function showReport($report, $patient_id, $patient_name, $date, $doctor)
    {
        $this->reset('report', 'patient_id', 'patient_name');
        $this->report = $report;
        $this->patient_id = $patient_id;
        $this->patient_name = $patient_name;
        $this->exam_date = date('d/m/Y', strtotime($date));
        $this->doctor = $doctor;
        $this->user = auth()->user()->name;
        $this->modalReport = true;
    }

    public function render()
    {
        return view('recepcao::livewire.schedules.show-reports');
    }
}
