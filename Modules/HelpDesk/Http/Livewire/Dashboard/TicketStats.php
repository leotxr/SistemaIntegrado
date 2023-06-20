<?php

namespace Modules\HelpDesk\Http\Livewire\Dashboard;

use Livewire\Component;
use Modules\HelpDesk\Entities\Ticket;

class TicketStats extends Component
{


    public function render()
    {
        $tma=  Ticket::whereBetween('ticket_open', [date('Y-m-d 00:00:00'), date('Y-m-d 23:59:59:59')])->avg('total_ticket');
        $tma_hoje = gmdate("h:i:s", $tma);
        return view('helpdesk::livewire.dashboard.ticket-stats', 
    [   
        'tma_hoje' => $tma_hoje
    ]);
    }
}
