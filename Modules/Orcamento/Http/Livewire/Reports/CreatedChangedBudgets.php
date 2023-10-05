<?php

namespace Modules\Orcamento\Http\Livewire\Reports;

use Livewire\Component;
use Modules\Orcamento\Entities\BudgetStatus;
use Modules\Orcamento\Entities\Budget;
use App\Models\User;
use Livewire\WithPagination;

class CreatedChangedBudgets extends Component
{
    use WithPagination;
    
    public $created_at;
    public $updated_ad;



    public function render()
    {
        return view('orcamento::livewire.reports.created-changed-budgets', ['statuses' => BudgetStatus::all(), 
            'orcamentos' => Budget::search('patient_name', $this->search)
            ->whereDate('updated_at', $this->updated_at)
            ->whereDate('created_at', $this->created_at)
            ->whereIn('last_user_id', $this->selectedUsers)
            ->whereIn('budget_status_id', $this->selectedStatuses)
            ->paginate(10),
            'users' => User::permission('criar orcamento')->get(),
            'statuses' => BudgetStatus::all()]);
    }
}
