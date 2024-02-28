<?php

namespace Modules\Laudo\Http\Livewire\Layout;

use Livewire\Component;

class PrintLayout extends Component
{
    public $patient_id = 'a';
    public $patient_name = 'a';
    public $exam_date = 'a';
    public $doctor = 'a';
    public $report = 'a';

    public function mount($patient_id, $patient_name, $exam_date, $doctor, $report)
    {

        $this->patient_id = $patient_id;
        $this->patient_name = $patient_name;
        $this->exam_date = $exam_date;
        $this->doctor = $doctor;
        $this->report = $report;
    }

    public function render()
    {
        return view('laudo::livewire.layout.print-layout');
    }
}
