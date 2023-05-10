<?php

namespace Modules\Triagem\Http\Livewire;

use Livewire\Component;

class TermFooter extends Component
{
    public $data_exame;
    public $title;
    public $description;
    public $img;
    public function mount($data_exame, $title, $description, $img)
    {
        $this->data_exame = $data_exame;
        $this->title = $title;
        $this->description = $description;
        $this->img = $img;
    }
   
    public function render()
    {
        return view('triagem::livewire.term-footer');
    }
}
