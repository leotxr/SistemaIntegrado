<?php

namespace Modules\Orcamento\Http\Livewire\Dashboard;

use Livewire\Component;
use Modules\Orcamento\Entities\BudgetStatus;
use Modules\Orcamento\Entities\Budget;

class BudgetByDay extends Component
{
    public $days = [];
    public $total_values = [];
    public $agendado = [];
    public $naoagendado = [];
    public $pendente = [];
    public $statuses;

    public function mount()
    {
        
        $this->days = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31];
        $this->statuses = BudgetStatus::all();

        foreach($this->days as $day)
        {
            $this->total_values[] = Budget::whereDay('created_at', $day)->count();
            $this->agendado[] = Budget::whereDay('created_at', $day)->where('budget_status_id', 3)->count(); 
            $this->naoagendado[] = Budget::whereDay('created_at', $day)->where('budget_status_id', 2)->count();
            $this->pendente[] = Budget::whereDay('created_at', $day)->where('budget_status_id', 1)->count();
        }
        $this->statuses = $this->statuses->pluck('name');

    }

    public function render()
    {
        return view('orcamento::livewire.dashboard.budget-by-day');
    }
}
