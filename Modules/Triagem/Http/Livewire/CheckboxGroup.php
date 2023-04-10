<?php

namespace Modules\Triagem\Http\Livewire;

use Livewire\Component;

class CheckboxGroup extends Component
{
    public $label;
    public $link;
    public function mount($label, $link)
    {
        $this->label = $label;
        $this->link = $link;
    }

    public function render()
    {
        return view('triagem::livewire.checkbox-group');
    }
}
