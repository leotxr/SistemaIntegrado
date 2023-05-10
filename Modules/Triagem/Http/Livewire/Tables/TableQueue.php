<?php

namespace Modules\Triagem\Http\Livewire\Tables;

use Livewire\Component;

class TableQueue extends Component
{
    public $pacientes;
    public $triagens;

    public function mount($pacientes, $triagens)
    {
        $this->pacientes = $pacientes;
        $this->triagens = $triagens;
    }
    public function render()
    {
        return view('triagem::livewire.tables.table-queue');
    }
}
