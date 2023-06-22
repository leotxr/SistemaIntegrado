<?php

namespace Modules\HelpDesk\Http\Livewire\Dashboard;

use DateTime;
use Livewire\Component;
use Modules\HelpDesk\Entities\Ticket;

class TicketStats extends Component
{


    public function render()
    {
        

        $hoje =  Ticket::whereBetween('ticket_open', [date('Y-m-d 00:00:00'), date('Y-m-d 23:59:59')])->whereNotNull('ticket_close')->avg('total_ticket');
        
        $tma_ontem = gmdate("H:i:s", Ticket::whereBetween('ticket_open', [date('Y-m-d 00:00:00', strtotime("-1 days")), date('Y-m-d 23:59:59', strtotime("-1 days"))])->avg('total_ticket'));
        $tma_7d = gmdate("H:i:s", Ticket::whereBetween('ticket_open', [date('Y-m-d 00:00:00', strtotime("-6 days")), date('Y-m-d 23:59:59')])->avg('total_ticket'));
        return view('helpdesk::livewire.dashboard.ticket-stats', 
    [   
        'tma_hoje' => $hoje,
        'tma_ontem' => $tma_ontem,
        'tma_7d' => $tma_7d

    ]);
    }
}
