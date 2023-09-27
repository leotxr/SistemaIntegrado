<?php

namespace Modules\Orcamento\Http\Livewire\Reports;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Orcamento\Entities\BudgetStatus;
use Modules\Orcamento\Entities\Budget;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Orcamento\Exports\BudgetsExport;
use App\Models\User;

class ChangedBudgets extends Component
{
    use WithPagination;
    public $initial_date;
    public $final_date;
    public $search = '';
    public $modalFilters = false;
    public $selectedUsers = [];
    public $selectedStatuses = [];



    public function search($initial_date, $final_date)
    {
        $this->initial_date = $initial_date;
        $this->final_date = $final_date;
        $this->render();
        //dd($this->orcamentos);
    }

    public function export()
    {
        $range = [
            'initial_date' => $this->initial_date,
            'final_date' => $this->final_date,
            'selected_users' => $this->selectedUsers,
            'selected_statuses' => $this->selectedStatuses
        ];
        return Excel::download(new BudgetsExport($range), 'solicitacoes-alteradas' . $this->initial_date . '-' . $this->final_date . '.xlsx');
    }

    public function render()
    {
        return view('orcamento::livewire.reports.changed-budgets', ['statuses' => BudgetStatus::all(), 
            'orcamentos' => Budget::search('patient_name', $this->search)
            ->whereColumn('updated_at', '>', 'created_at')
            ->whereBetween('budget_date', [$this->initial_date, $this->final_date])
            ->whereIn('last_user_id', $this->selectedUsers)
            ->whereIn('budget_status_id', $this->selectedStatuses)
            ->paginate(10),
            'users' => User::permission('criar orcamento')->get(),
            'statuses' => BudgetStatus::all()]);
    }
}
