<?php

namespace Modules\Orcamento\Http\Livewire\Reports;

use Livewire\Component;
use Modules\Orcamento\Entities\Budget;
use Modules\Orcamento\Entities\BudgetStatus;
use Modules\Orcamento\Entities\BudgetType;
use App\Models\User;

class TotalizerBudgets extends Component
{
    public $selectedUsers = [];
    public $selectedStatuses = [];
    public $initial_date;
    public $final_date;
    public $modalFilters = false;


    public function render()
    {
        return view('orcamento::livewire.reports.totalizer-budgets', [
            'statuses' => BudgetStatus::all(),
            'orcamentos' => Budget::whereBetween('budget_date', [$this->initial_date, $this->final_date])
                ->get(),
            'users' => User::permission('criar orcamento')->get(),
        ]);
    }
}
