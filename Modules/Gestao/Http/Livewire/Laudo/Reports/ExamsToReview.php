<?php

namespace Modules\Gestao\Http\Livewire\Laudo\Reports;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Gestao\Traits\LaudoQueries;

class ExamsToReview extends Component
{
    use LaudoQueries;
    use WithPagination;

    public $medicos;
    public $setores;
    public $selection;
    public $selectAll = false;
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

    public function selectAll()
    {
        if ($this->selectAll)
            $this->medicos_selecionados = $this->medicos;
        else
            $this->medicos_selecionados = [];
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
