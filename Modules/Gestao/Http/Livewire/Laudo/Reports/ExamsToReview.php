<?php

namespace Modules\Gestao\Http\Livewire\Laudo\Reports;

use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Gestao\Exports\Laudo\ExamsExport;
use Modules\Gestao\Traits\LaudoQueries;

class ExamsToReview extends Component
{
    use LaudoQueries;
    use WithPagination;

    public $medicos;
    public $setores;
    public $selection;
    public $selectAllDoctors = false;
    public $selectAllSectors = false;
    public $date_by = 'FATURA.DATA';
    public $medicos_selecionados = [];
    public $setores_selecionados = [];
    public $modal_medicos = false;
    public $modal_setores = false;
    public $start_date;
    public $end_date;

    public function mount()
    {
        $this->medicos = json_decode(json_encode($this->getDoctors()), true);
        $this->setores = json_decode(json_encode($this->getSectors()), true);

    }

    public function updatedselectAllDoctors($value)
    {
        if ($value) {
            $this->medicos_selecionados = array_column($this->medicos, 'NOME');
        } else
            $this->medicos_selecionados = [];
    }

    public function updatedselectAllSectors($value)
    {
        if ($value) {
            $this->setores_selecionados = array_column($this->setores, 'DESCRICAO');
        } else
            $this->setores_selecionados = [];
    }

    public function remove($arr_ref, $name)
    {
        switch ($arr_ref) {
            case 1:
                $key = array_search($name, $this->medicos_selecionados);
                unset($this->medicos_selecionados[$key]);
                break;
            case 2:
                $key = array_search($name, $this->setores_selecionados);
                unset($this->setores_selecionados[$key]);
                break;

        }

    }


    public function search()
    {
        $this->render();
    }

    public function export()
    {
        $range = [
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'date_by' => $this->date_by,
            'medicos_selecionados' => $this->medicos_selecionados,
            'setores_selecionados' => $this->setores_selecionados,
            'query_type' => 3
        ];
        return Excel::download(new ExamsExport($range), 'exams-sem-revisar' . $this->start_date . '-' . $this->end_date . '.xlsx');
    }

    public function render()
    {

        return view('gestao::livewire.laudo.reports.exams-to-review',
            ['db' => $this->queryReportsRevisor($this->medicos_selecionados, $this->setores_selecionados)
                ->whereNotNull('FATVOICE.ARQUIVO')
                ->whereNull('FATURA.LAUDOREV')
                ->where('FATURA.LAUDOREAOK', 'T')
                ->where('FATURA.LAUDOASSOK', 'T')
                ->whereBetween("$this->date_by", ["$this->start_date", "$this->end_date"])
                ->orderBy('HORA_EXAME')
                ->paginate(20)]);
    }
}
