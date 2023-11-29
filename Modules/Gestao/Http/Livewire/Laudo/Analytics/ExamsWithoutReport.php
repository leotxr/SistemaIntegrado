<?php

namespace Modules\Gestao\Http\Livewire\Laudo\Analytics;

use Livewire\Component;
use Modules\Gestao\Traits\LaudoQueries;

class ExamsWithoutReport extends Component
{

    use LaudoQueries;

    public $db;
    public $start_date;
    public $end_date;
    public $medicos;
    public $setores;

    protected $listeners = [
        'refreshChildren' => 'refreshMe'
    ];

    public function refreshMe($start_date, $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->db = $this->getLaudosStatus($this->start_date, $this->end_date)->where('DIGITADO', 'F')->whereNull('DITADO');
        $this->medicos = $this->db->groupBy('MEDICO')->keys();
        $this->setores = $this->db->groupBy('NOMESETOR')->keys();
    }

    public function mount($start_date, $end_date)
    {

        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->db = $this->getLaudosStatus($this->start_date, $this->end_date)->where('DIGITADO', 'F')->whereNull('DITADO');
        $this->medicos = $this->db->groupBy('MEDICO')->keys();
        $this->setores = $this->db->groupBy('NOMESETOR')->keys();

        //dd($this->setores);
        //dd($this->db->where("MEDICOID", 1187)->where('SETOR', 1)->count());
    }

    public function render()
    {
        return view('gestao::livewire.laudo.analytics.exams-without-report');
    }
}
