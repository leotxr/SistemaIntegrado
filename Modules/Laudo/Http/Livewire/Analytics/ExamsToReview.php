<?php

namespace Modules\Laudo\Http\Livewire\Analytics;

use Livewire\Component;
use Modules\Laudo\Traits\LaudoQueries;

class ExamsToReview extends Component
{
    use LaudoQueries;

    public $db;
    public $start_date ;
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
        $this->db = $this->getLaudosRevisao($this->start_date, $this->end_date)->whereNotNull('MEDICO');
        $this->medicos = $this->db->groupBy('MEDICO')->keys();
        $this->setores = $this->db->groupBy('NOMESETOR')->keys();
    }

    public function mount($start_date, $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->db = $this->getLaudosRevisao($this->start_date, $this->end_date)->whereNotNull('MEDICO');
        $this->medicos = $this->db->groupBy('MEDICO')->keys();
        $this->setores = $this->db->groupBy('NOMESETOR')->keys();

    }

    public function render()
    {
        return view('laudo::livewire.analytics.exams-to-review');
    }
}
