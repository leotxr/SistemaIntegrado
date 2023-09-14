<?php

namespace Modules\Orcamento\Http\Livewire\Dashboard;

use Livewire\Component;
use Modules\Orcamento\Entities\Budget;

class BudgetStats extends Component
{
    public $count_budgets;

    public function mount()
    {
        $this->count_budgets = Budget::whereMonth('created_at', date('m'))->get();
    }
    
    public function render()
    {
        return view('orcamento::livewire.dashboard.budget-stats');
    }
}
