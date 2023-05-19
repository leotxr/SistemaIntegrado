<?php

namespace Modules\Triagem\Http\Livewire;

use Livewire\Component;
use Modules\Triagem\Entities\Question;

class QuestionarioRM extends Component
{
    public $perguntas;

    public function mount()
    {
        $this->perguntas = Question::where('sector_id', 1)->get();
    }
    
    public function render()
    {
        return view('triagem::livewire.questionario-r-m');
    }
}
