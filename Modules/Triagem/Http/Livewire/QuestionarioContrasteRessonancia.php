<?php

namespace Modules\Triagem\Http\Livewire;

use Livewire\Component;
use Modules\Triagem\Entities\Question;

class QuestionarioContrasteRessonancia extends Component
{
    public $perguntas;
    public $i;

    public function mount()
    {
        $this->perguntas = Question::where('sector_id', 1)->where('file_type_id', 4)->get();
    }

    public function render()
    {
        return view('triagem::livewire.questionario-contraste-ressonancia');
    }
}
