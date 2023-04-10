<?php

namespace Modules\Triagem\Http\Livewire;

use Livewire\Component;

class TermHeader extends Component
{

    public $paciente;
    public $data_nascimento;
    public $inicio_triagem;
    public $data_exame;
    public $procedimento;
    public $pacienteid;
    
    public function mount($paciente, $data_nascimento, $inicio_triagem, $data_exame, $procedimento, $pacienteid)
    {
        $this->paciente = $paciente;
        $this->data_nascimento = $data_nascimento;
        $this->inicio_triagem = $inicio_triagem;
        $this->data_exame = $data_exame;
        $this->procedimento = $procedimento;
        $this->pacienteid = $pacienteid;
    }

    public function render()
    {
        return view('triagem::livewire.term-header');
    }
}
