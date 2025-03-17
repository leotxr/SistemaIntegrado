<?php

namespace Modules\HelpDesk\Http\Livewire\Reports\ExtraServices;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\HelpDesk\Entities\ExtraService;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TicketsExport;
use Modules\HelpDesk\Traits\TicketActions;

class ExtraServicesReport extends Component
{
    use WithPagination;
    use TicketActions;

    public $initial_date;
    public $final_date;


    public function export()
    {
        $range = ['initial_date'=>$this->initial_date,
        'final_date'=>$this->final_date];
        return Excel::download(new TicketsExport($range), 'tickets'.now().'.xlsx');
    }

    public function render()
    {
        return view('helpdesk::livewire.reports.extra-services.extra-services-report')
        ->layout('helpdesk::layouts.master')
        ->section('body');
    }
}