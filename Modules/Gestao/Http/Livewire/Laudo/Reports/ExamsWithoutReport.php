<?php

namespace Modules\Gestao\Http\Livewire\Laudo\Reports;

use Illuminate\Support\Collection;
use Livewire\Component;
use Modules\Gestao\Traits\LaudoQueries;
use App\Models\User;

class ExamsWithoutReport extends Component
{
    use LaudoQueries;

    public $medicos;
    public $setores;
    public $selection;
    public $db = [];
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

    public function search()
    {
        $query = $this->withoutReport($this->start_date, $this->end_date)
            ->whereIn('MEDICO', $this->medicos_selecionados)
            ->whereIn('SETOR', $this->setores_selecionados)
            ->where('DIGITADO', 'F')
            ->whereNull('DITADO');

        $this->db = json_decode(json_encode($query), true);
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

    public function add()
    {

    }

    public function render()
    {
        return view('gestao::livewire.laudo.reports.exams-without-report');
    }
}
