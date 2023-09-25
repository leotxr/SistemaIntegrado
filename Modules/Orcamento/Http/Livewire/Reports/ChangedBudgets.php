<?php

namespace Modules\Orcamento\Http\Livewire\Reports;

use Livewire\Component;

class ChangedBudgets extends Component
{
    public function render()
    {
        return view('orcamento::livewire.reports.changed-budgets')->layout('orcamento::layouts.master')
        ->slot('main');
    }
}
