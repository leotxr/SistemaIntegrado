<?php

namespace Modules\Orcamento\Http\Livewire\Reports;

use Livewire\Component;
use Modules\Orcamento\Entities\Budget;
use Modules\Orcamento\Entities\BudgetStatus;
use App\Models\User;

class TotalizerChangedBudgets extends Component
{
    public $selectedUsers = [];
    public $selectedStatuses = [];
    public $initial_date;
    public $final_date;
    public $modalFilters = false;

    /*
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
    */

    public function render()
    {
        return view('orcamento::livewire.reports.totalizer-changed-budgets', [
            'statuses' => BudgetStatus::whereIn('id', [2, 3, 4, 5])->get(),
            'orcamentos' => Budget::whereBetween('updated_at', [$this->initial_date . "00:00:00", $this->final_date . "23:59:59"])
            ->whereIn('budget_status_id', [2, 3, 4, 5])
                ->get(),
            'users' => User::permission('criar orcamento')->orderBy('name', 'ASC')->get(),
        ]);
    }
}
