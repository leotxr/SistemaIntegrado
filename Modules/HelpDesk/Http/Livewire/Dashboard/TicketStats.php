<?php

namespace Modules\HelpDesk\Http\Livewire\Dashboard;

use DateTime;
use Livewire\Component;
use Modules\HelpDesk\Entities\Ticket;

class TicketStats extends Component
{


    public function render()
    {
        

        $tma_hoje =  gmdate("H:i:s", Ticket::whereBetween('ticket_open', [date('Y-m-d 00:00:00'), date('Y-m-d 23:59:59')])->avg('total_ticket'));
        $tma_ontem = gmdate("H:i:s", Ticket::whereBetween('ticket_open', [date('Y-m-d 00:00:00', strtotime("-1 days")), date('Y-m-d 23:59:59', strtotime("-1 days"))])->avg('total_ticket'));
        //$tma_hoje = $tma->format("%H:%I:%S");
        return view('helpdesk::livewire.dashboard.ticket-stats', 
    [   
        'tma_hoje' => $tma_hoje,
        'tma_ontem' => $tma_ontem
    ]);
    }
}
