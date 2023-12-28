<?php

namespace Modules\NC\Http\Livewire\Utils;

use Livewire\Component;

class LoadingScreen extends Component
{
    public function render()
    {
        return view('nc::livewire.utils.loading-screen');
    }
}
