<?php

namespace Modules\Triagem\Http\Livewire;

use Livewire\Component;

class BottomNavigation extends Component
{
    public $submit_title;
    public function mount($submit_title)
    {
        $this->submit_title = $submit_title;
    }

    public function render()
    {
        return view('triagem::livewire.bottom-navigation');
    }
}
