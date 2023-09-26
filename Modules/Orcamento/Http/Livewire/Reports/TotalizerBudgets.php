<?php

namespace Modules\Orcamento\Http\Livewire\Reports;

use Livewire\Component;
use Modules\Orcamento\Entities\Budget;

class TotalizerBudgets extends Component
{
    public $users = [];
    public function render()
    {
        return view('orcamento::livewire.reports.totalizer-budgets', ['orcamentos' => Budget::whereIn('last_user_id', $this->users)]);
    }
}
