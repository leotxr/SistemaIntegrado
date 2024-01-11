<?php

namespace Modules\Triagem\Http\Livewire\Tables;

use Livewire\Component;

class TableQueue extends Component
{
    public $pacientes;
    public $triagens;
    public $setor;

    public function mount($pacientes, $triagens, $setor)
    {
        $this->pacientes = $pacientes;
        $this->triagens = $triagens;
        $this->setor = $setor;


    }
    public function render()
    {
        return view('triagem::livewire.tables.table-queue');
    }
}
