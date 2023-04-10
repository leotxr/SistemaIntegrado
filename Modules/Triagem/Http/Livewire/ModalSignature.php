<?php

namespace Modules\Triagem\Http\Livewire;

use Livewire\Component;

class ModalSignature extends Component
{
    public $title;
    public function mount($title)
    {
        $this->title = $title;
    }
    public function render()
    {
        return view('triagem::livewire.modal-signature');
    }
}
