<?php

namespace Modules\Orcamento\Http\Livewire\Budget;

use Livewire\Component;
use Modules\Orcamento\Entities\BudgetType;

class BudgetTiles extends Component
{
    public function render()
    {
        return view('orcamento::livewire.budget.budget-tiles');
    }

}
