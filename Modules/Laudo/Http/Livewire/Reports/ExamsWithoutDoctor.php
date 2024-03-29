<?php

namespace Modules\Laudo\Http\Livewire\Reports;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Laudo\Traits\LaudoQueries;

class ExamsWithoutDoctor extends Component
{
    use LaudoQueries;
    use WithPagination;

    public $medicos;
    public $setores;
    public $selection;
    public $by_doctor = 'FATURA.MEDREAID';
    public $selectAllSectors = false;
    public $date_by = 'FATURA.DATA';
    public $setores_selecionados = [];
    public $modal_setores = false;
    public $start_date;
    public $end_date;


    public function mount()
    {


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
                return 1;
            case 2:
                $key = array_search($name, $this->setores_selecionados);
                unset($this->setores_selecionados[$key]);
                break;

        }

    }

    public function export()
    {
        return 1;
    }


    public function search()
    {
        $this->render();
    }

    public function render()
    {
        if ($this->by_doctor === 'FATURA.MEDREAID')
            $this->setores = json_decode(json_encode($this->getSectors()), true);
        else
            $this->setores = json_decode(json_encode($this->getSectors()->whereIn('SETORID', [2, 4, 9])), true);

        return view('laudo::livewire.reports.exams-without-doctor',
            ['db' => $this->queryWithoutDoctor($this->setores_selecionados)
                ->whereNull($this->by_doctor)
                ->whereBetween("$this->date_by", ["$this->start_date", "$this->end_date"])
                ->orderBy('DATA_EXAME')
                ->orderBy('HORA_EXAME')
                ->paginate(20)]);
    }
}
