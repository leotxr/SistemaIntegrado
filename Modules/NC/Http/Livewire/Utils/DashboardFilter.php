<?php

namespace Modules\NC\Http\Livewire\Utils;

use Livewire\Component;

class DashboardFilter extends Component
{
    public $start_date;
    public $end_date;

    public function refreshChildren()
    {
        $this->emitUp('refreshChildren', $this->start_date, $this->end_date);
    }

    public function render()
    {
        return view('nc::livewire.utils.dashboard-filter');
    }
}
