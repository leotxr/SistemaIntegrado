<?php

namespace Modules\Orcamento\Http\Livewire\Dashboard;

use Livewire\Component;
use Modules\Orcamento\Entities\BudgetStatus;
use Modules\Orcamento\Entities\Budget;

class BudgetByMonth extends Component
{
    public $days = [];
    public $total_values = [];
    public $agendado = [];
    public $naoagendado = [];
    public $pendente = [];
    public $statuses;

    protected $listeners = [
        'echo:budget-dashboard,BudgetCreated' => '$refresh',
    ];

    public function mount()
    {
        
        $this->days = [1,2,3,4,5,6,7,8,9,10,11,12];
        $this->statuses = BudgetStatus::all();

        foreach($this->days as $month)
        {
            $this->total_values[] = Budget::whereMonth('created_at', $month)->count();
            $this->agendado[] = Budget::whereMonth('created_at', $month)->where('budget_status_id', 3)->count(); 
            $this->naoagendado[] = Budget::whereMonth('created_at', $month)->where('budget_status_id', 2)->count();
            $this->pendente[] = Budget::whereMonth('created_at', $month)->where('budget_status_id', 1)->count();
        }

        $this->statuses = $this->statuses->pluck('name');

    }

    public function render()
    {
        return view('orcamento::livewire.dashboard.budget-by-month');
    }
}
