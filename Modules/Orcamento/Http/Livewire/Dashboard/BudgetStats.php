<?php

namespace Modules\Orcamento\Http\Livewire\Dashboard;

use Livewire\Component;
use Modules\Orcamento\Entities\Budget;
use Modules\Orcamento\Entities\BudgetType;
use Modules\Orcamento\Entities\BudgetStatus;

class BudgetStats extends Component
{
    public $submonth;
    public $statusesChart = [];
    public $budgetsChart = [];

    protected $listeners = ['refreshChildren' => 'refreshMe'];

    public function refreshMe($submonth)
    {
        $this->submonth = $submonth;

        foreach (BudgetStatus::all() as $status) {
            $budgetsChart[] = Budget::where('budget_status_id', $status->id)->whereBetween('budget_date', [today()->subDays($this->submonth), today()->subDays(0)])->count();
        }
        $budgetsChart = array_replace($this->budgetsChart, $budgetsChart);
        $this->emit('refreshChart', ['seriesData' => $budgetsChart]);
    }

    public function mount($submonth)
    {
        $this->submonth = $submonth;

        foreach (BudgetStatus::all() as $status) {
            $this->statusesChart[] = $status->name;
            $this->budgetsChart[] = Budget::where('budget_status_id', $status->id)->whereBetween('budget_date', [today()->subDays($this->submonth), today()->subDays(0)])->count();
        }
    }

    public function render()
    {

        return view(
            'orcamento::livewire.dashboard.budget-stats',
            [
                'budgets' => Budget::whereBetween('budget_date', [today()->subDays($this->submonth), today()->subDays(0)])->get(),
                'types' => BudgetType::all(),
                'statuses' => BudgetStatus::all()
            ]
        );
    }
}
