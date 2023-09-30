<?php

namespace Modules\Orcamento\Http\Livewire\Dashboard;

use Livewire\Component;
use Modules\Orcamento\Entities\Budget;

class Analytics extends Component
{
    public $submonth = 7;


    public function refreshChildren()
    {
        $this->emit('refreshChildren', $this->submonth);
    }

    public function render()
    {
        return view('orcamento::livewire.dashboard.analytics', 
        ['budgets' => Budget::whereBetween('budget_date', [today()->subDays($this->submonth), today()->subDays(0)])->get()]);
    }
}
