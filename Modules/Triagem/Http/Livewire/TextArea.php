<?php

namespace Modules\Triagem\Http\Livewire;

use Livewire\Component;

class TextArea extends Component
{
    public $label;
    public $description;
    public function render()
    {
        return view('triagem::livewire.text-area');
    }
}
