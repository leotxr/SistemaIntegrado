<?php

namespace Modules\Orcamento\Http\Livewire\Reports;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('orcamento::livewire.reports.index')->layout('orcamento::layouts.master')
        ->slot('main');
    }
}
