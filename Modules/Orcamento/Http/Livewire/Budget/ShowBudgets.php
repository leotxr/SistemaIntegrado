<?php

namespace Modules\Orcamento\Http\Livewire\Budget;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Orcamento\Entities\Budget;

class ShowBudgets extends Component
{
    use WithPagination;
    public $modalBudget = false;
    public $modalDetails = false;
    public Budget $showing;

    protected $listeners = [
        'closeModal' => 'closeModalBudget',
        'echo:budget-dashboard,BudgetUpdated' => '$refresh',
    ];

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
        $this->render();
    }
    
    public function render()
    {
        return view('orcamento::livewire.budget.show-budgets', ['orcamentos' => Budget::paginate(10)]);
    }
}
