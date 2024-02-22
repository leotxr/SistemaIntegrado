<?php

namespace Modules\Recepcao\Http\Livewire\Schedules;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use RtfHtmlPhp\Document;
use RtfHtmlPhp\Html\HtmlFormatter;

class ShowExams extends Component
{
    public $modalExams = false;
    public $patient_exams;
    public $report;
    public $formatted = '';
    public $patient_id;
    public $patient_name = '';


    protected $listeners = [
        'getExams'
    ];

    public function getExams($patient_id, $patient_name)
    {
        $this->patient_id = $patient_id;
        $this->patient_name = $patient_name;
        $this->render();
        $this->modalExams = true;
    }

    public function getReport($fatura_id, $patient_id)
    {
        $this->reset('report', 'formatted');
        $report = DB::connection('sqlserver')->table('FATURALAUDO')
            ->where('FATURAID', $fatura_id)
            ->where('PACIENTEID', $patient_id)
            ->select('LAUDO')
            ->first();

        //dd($this->report[0]['LAUDO']);
        //file_put_contents("teste.rtf", $this->report->LAUDO);
        $doc = new Document($report->LAUDO);
        $formatter = new HtmlFormatter('UTF-8');
        $this->formatted = $formatter->Format($doc);

        $this->emit('showReport', $this->formatted, $patient_id, $this->patient_name);

    }


    public function render()
    {

        $this->patient_exams = DB::connection('sqlserver')->table('FATURA')
            ->where('UNIDADEID', 1)
            ->where('PACIENTEID', $this->patient_id)
            ->where('DATA', "<", date('Y-m-d'))
            ->whereIn('SETORID', [5, 10])
            ->select('DATA', 'PACIENTEID', 'FATURAID', 'LAUDONOMEEXAME')
            ->distinct()
            ->orderBy('DATA', 'desc')
            ->get();
        return view('recepcao::livewire.schedules.show-exams');
    }
}
