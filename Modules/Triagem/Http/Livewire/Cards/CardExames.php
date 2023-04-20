<?php

namespace Modules\Triagem\Http\Livewire\Cards;

use Livewire\Component;

class CardExames extends Component
{
    public $path;
    public $label;
    public $link;

    public function mount($path, $label, $link)
    {
        $this->path = $path;
        $this->label = $label; 
        $this->link = $link;
    }
    public function render()
    {
        return view('triagem::livewire.cards.card-exames');
    }
}
