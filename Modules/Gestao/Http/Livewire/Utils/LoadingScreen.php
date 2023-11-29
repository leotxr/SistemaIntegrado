<?php

namespace Modules\Gestao\Http\Livewire\Utils;

use Livewire\Component;

class LoadingScreen extends Component
{
    public function render()
    {
        return view('gestao::livewire.utils.loading-screen');
    }
}
