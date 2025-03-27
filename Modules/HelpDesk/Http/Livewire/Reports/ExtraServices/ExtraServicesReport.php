<?php

namespace Modules\HelpDesk\Http\Livewire\Reports\ExtraServices;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\HelpDesk\Entities\ExtraService;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExtraServicesExport;
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
        return Excel::download(new ExtraServicesExport($range), 'servicosExtras'.now().'.xlsx');
    }

    public function render()
    {
        return view('helpdesk::livewire.reports.extra-services.extra-services-report',
        ['tickets' => 
        ExtraService::whereBetween('extra_services.created_at', [$this->initial_date . ' 00:00:00', $this->final_date . ' 23:59:59'])
        ->join('users', 'users.id', '=', 'extra_services.requester_id')
        ->join('ticket_statuses', 'ticket_statuses.id', '=', 'extra_services.status_id')
        ->selectRaw('extra_services.id AS id, users.name AS solicitante, ticket_statuses.name as status, 
        extra_services.title AS titulo, extra_services.description AS descricao, extra_services.sector AS setor,
        extra_services.created_at AS datahora, extra_services.item AS item, extra_services.action AS acao, extra_services.is_ticket as ticket_ti')
        ->paginate(10)])
        ->layout('helpdesk::layouts.master')
        ->section('body');
    }
}
