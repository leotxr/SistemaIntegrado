<?php

namespace Modules\Laudo\Http\Livewire\Analytics;

use Livewire\Component;
use Modules\Laudo\Traits\LaudoQueries;

class ExamsWithoutSignature extends Component
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
        $this->db = $this->getLaudosStatus($this->start_date, $this->end_date)->where('DIGITADO', 'T')->where('ASSINADO', 'F');
        $this->medicos = $this->db->groupBy('MEDICO')->keys();
        $this->setores = $this->db->groupBy('NOMESETOR')->keys();
    }

    public function mount($start_date, $end_date)
    {

        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->db = $this->getLaudosStatus($this->start_date, $this->end_date)->where('DIGITADO', 'T')->where('ASSINADO', 'F');
        $this->medicos = $this->db->groupBy('MEDICO')->keys();
        $this->setores = $this->db->groupBy('NOMESETOR')->keys();

        //dd($this->db);
        //dd($this->db->where("MEDICOID", 1187)->where('SETOR', 1)->count());
    }

    public function render()
    {
        return view('laudo::livewire.analytics.exams-without-signature');
    }
}
