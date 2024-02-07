<?php

namespace App\Http\Livewire\Layouts;

use Livewire\Component;

class Navigation extends Component
{
    public $name;
    public function mount($name)
    {
        $this->name = $name;
    }
    public function render()
    {
        return view('livewire.layouts.navigation');
    }
}
