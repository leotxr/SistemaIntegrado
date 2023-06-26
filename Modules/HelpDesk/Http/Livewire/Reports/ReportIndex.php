<?php

namespace Modules\HelpDesk\Http\Livewire\Reports;

use Livewire\Component;

class ReportIndex extends Component
{
    public function mount()
    {
    }

    public function render()
    {
        return view('helpdesk::livewire.reports.report-index')->layout('helpdesk::layouts.master')
        ->slot('main');
    }
}
