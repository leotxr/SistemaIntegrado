<?php

namespace Modules\Gestao\Http\Livewire\Testing;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Gestao\Traits\LaudoQueries;

class TestQuery extends Component
{
    use LaudoQueries;

    public $db;
    public $start_date ;
    public $end_date;
    public $medicos;
    public $setores;
    public $modalFilters = true;

    protected $listeners = [
      'refreshAnalytics' => 'refreshMe'
    ];


    public function mount()
    {

        $this->start_date = '2023-11-22';
        $this->end_date = date('Y-m-d');
        $this->db = $this->getLaudosRevisao($this->start_date, $this->end_date)->whereNotNull('MEDICO');
        $this->medicos = $this->db->groupBy('MEDICO')->keys();
        $this->setores = $this->db->groupBy('NOMESETOR')->keys();
        //dd($this->db);
        //dd($this->setores);
        //dd($this->db->where("MEDICOID", 1187)->where('SETOR', 1)->count());
    }



    public function refreshMe($date1, $date2)
    {

    }


    public function render()
    {
        return view('gestao::livewire.testing.test-query');
    }
}
