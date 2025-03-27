<?php

namespace App\Exports;

use Modules\HelpDesk\Entities\ExtraService;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Modules\HelpDesk\Traits\TicketActions;

class ExtraServicesExport implements FromView
{
    use Exportable;
    use TicketActions;

    public $start;
    public $end;

    public function __construct($range)
    {
        $this->start = $range['initial_date'];
        $this->end = $range['final_date'];
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        return view(
            'helpdesk::reports.tables.table-extra-services',
            ['tickets' => ExtraService::whereBetween('extra_services.created_at', [$this->start . ' 00:00:00', $this->end . ' 23:59:59'])
                ->join('users', 'users.id', '=', 'extra_services.requester_id')
                ->join('ticket_statuses', 'ticket_statuses.id', '=', 'extra_services.status_id')
                ->selectRaw('extra_services.id AS id, users.name AS solicitante, ticket_statuses.name as status, 
        extra_services.title AS titulo, extra_services.description AS descricao, extra_services.sector AS setor,
        extra_services.created_at AS datahora, extra_services.item AS item, extra_services.action AS acao, extra_services.is_ticket as ticket_ti')->get()]
        );
    }
}
