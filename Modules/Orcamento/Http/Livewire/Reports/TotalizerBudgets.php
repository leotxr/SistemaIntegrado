<?php

namespace Modules\Orcamento\Http\Livewire\Reports;

use Livewire\Component;
use Modules\Orcamento\Entities\Budget;
use Modules\Orcamento\Entities\BudgetStatus;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Orcamento\Exports\TotalizerBudgetsExport;

use App\Models\User;

class TotalizerBudgets extends Component
{
    public $selectedUsers = [];
    public $selectedStatuses = [];
    public $initial_date;
    public $final_date;
    public $modalFilters = false;

    public function export()
    {
        $range = [
            'initial_date' => $this->initial_date,
            'final_date' => $this->final_date,
            'selected_users' => $this->selectedUsers,
            'selected_statuses' => $this->selectedStatuses
        ];
        return Excel::download(new TotalizerBudgetsExport($range), 'totalizador-solicitacoes' . $this->initial_date . '-' . $this->final_date . '.xlsx');
    }

    public function render()
    {
        return view('orcamento::livewire.reports.totalizer-budgets', [
            'statuses' => BudgetStatus::all(),
            'orcamentos' => Budget::whereBetween('budget_date', [$this->initial_date, $this->final_date])
                ->get(),
            'users' => User::permission('criar orcamento')->orderBy('name', 'ASC')->get(),
        ]);
    }
}
