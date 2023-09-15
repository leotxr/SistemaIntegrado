<?php

namespace Modules\Orcamento\Http\Livewire\Dashboard;

use Livewire\Component;

class Analytics extends Component
{
    public $submonth = 1;

    public function generate()
    {
        $this->emit('change-submonth', $this->submonth);
    }
    public function render()
    {
        return view('orcamento::livewire.dashboard.analytics');
    }
}
