<?php

namespace Modules\Orcamento\Http\Livewire\Dashboard;

use Livewire\Component;
use Modules\Orcamento\Entities\Budget;

class BudgetStats extends Component
{
    public $submonth = 1;

    protected $listeners = [ 'change-submonth' => 'changesubmonth'];

    public function changesubmonth($submonth)
    {
        $this->submonth = $submonth;
        $this->render();
    }

    public function render()
    {
        
        return view('orcamento::livewire.dashboard.budget-stats', ['count_budgets' => Budget::whereBetween('budget_date', [today()->subMonths($this->submonth), today()->subMonths(0)])->get()]);
    }
}
