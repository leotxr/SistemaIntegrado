<?php

namespace Modules\Orcamento\Http\Livewire\Budget;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Orcamento\Entities\Budget;
use Modules\Orcamento\Entities\BudgetStatus;

class ShowBudgets extends Component
{
    use WithPagination;
    public $modalBudget = false;
    public $modalDetails = false;
    public Budget $showing;
    public $initial_date;
    public $final_date;
    public $selectedStatus = [1];
    public $search = '';

    protected $listeners = [
        'close-modal' => 'closeModalBudget',
        'echo:budget-dashboard,BudgetUpdated' => 'render',
        'budget-updated' => '$refresh'
    ];

    public function mount()
    {
        $this->initial_date = today()->subDays(4)->format('Y-m-d');
        $this->final_date = today()->format('Y-m-d');
    }

    public function openModalBudget()
    {
        $this->modalBudget = true;
    }

    public function openModalDetails(Budget $orcamento)
    {
        $this->showing = $orcamento;
        $this->modalDetails = true;
    }

    public function closeModalBudget()
    {
        $this->modalBudget = false;
        $this->modalDetails = false;
        $this->render();
    }


    public function render()
    {
        return view('orcamento::livewire.budget.show-budgets', ['orcamentos' => Budget::search('patient_name', $this->search)->whereIn('budget_status_id', $this->selectedStatus)
        ->whereBetween('budget_date', [$this->initial_date, $this->final_date])
        ->paginate(10),
        'statuses' => BudgetStatus::all()]);
    }
}
