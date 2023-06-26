<?php

namespace Modules\HelpDesk\Http\Livewire\Dashboard;

use DateTime;
use Livewire\Component;
use Modules\HelpDesk\Entities\Ticket;

class TicketStats extends Component
{


    public function render()
    {
        $tme_hoje =  Ticket::whereBetween('ticket_open', [date('Y-m-d 00:00:00'), date('Y-m-d 23:59:59')])->whereNotNull('ticket_start')->avg('wait_time');
        $tme_ontem = Ticket::whereBetween('ticket_open', [date('Y-m-d 00:00:00', strtotime("-1 days")), date('Y-m-d 23:59:59', strtotime("-1 days"))])->whereNotNull('ticket_start')->avg('wait_time');
        $tme_7d = Ticket::whereBetween('ticket_open', [date('Y-m-d 00:00:00', strtotime("-6 days")), date('Y-m-d 23:59:59')])->whereNotNull('ticket_start')->avg('wait_time');

        $tma_hoje =  Ticket::whereBetween('ticket_open', [date('Y-m-d 00:00:00'), date('Y-m-d 23:59:59')])->whereNotNull('ticket_close')->avg('total_ticket');
        $tma_ontem = Ticket::whereBetween('ticket_open', [date('Y-m-d 00:00:00', strtotime("-1 days")), date('Y-m-d 23:59:59', strtotime("-1 days"))])->whereNotNull('ticket_close')->avg('total_ticket');
        $tma_7d = Ticket::whereBetween('ticket_open', [date('Y-m-d 00:00:00', strtotime("-6 days")), date('Y-m-d 23:59:59')])->whereNotNull('ticket_close')->avg('total_ticket');
        return view('helpdesk::livewire.dashboard.ticket-stats', 
    [   
        'tma_hoje' => $tma_hoje,
        'tma_ontem' => $tma_ontem,
        'tma_7d' => $tma_7d,
        'tme_hoje' => $tme_hoje,
        'tme_ontem' => $tme_ontem,
        'tme_7d' => $tme_7d

    ]);
    }
}
