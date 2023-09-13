<?php

namespace Modules\Orcamento\Http\Livewire\Dashboard;

use Livewire\Component;
use Modules\Orcamento\Entities\BudgetStatus;
use Modules\Orcamento\Entities\Budget;

class ChartStatuses extends Component
{
    public $days = [];
    public $total_values = [];
    public $agendado = [];
    public $naoagendado = [];
    public $pendente = [];
    public $statuses;

    public function mount()
    {
        $this->days = [today()->subMonths(4)->format('m'), today()->subMonths(3)->format('m'), today()->subMonths(2)->format('m'), today()->subMonths(1)->format('m'), today()->subDays(0)->format('m')];
        $this->statuses = BudgetStatus::all();
        /*
        foreach($this->statuses as $status)
        {
            $this->values[] = Budget::where('budget_status_id', $status->id)->count();
        }
        */
        foreach($this->days as $month)
        {
            $this->total_values[] = Budget::whereMonth('created_at', $month)->count();
        }
        foreach($this->days as $month)
        {
            $this->agendado[] = Budget::whereMonth('created_at', $month)->where('budget_status_id', 3)->count();
        }
        foreach($this->days as $month)
        {
            $this->naoagendado[] = Budget::whereMonth('created_at', $month)->where('budget_status_id', 2)->count();
        }
        foreach($this->days as $month)
        {
            $this->pendente[] = Budget::whereMonth('created_at', $month)->where('budget_status_id', 1)->count();
        }
        $this->statuses = $this->statuses->pluck('name');

    }

    public function render()
    {
        return view('orcamento::livewire.dashboard.chart-statuses');
    }
}
