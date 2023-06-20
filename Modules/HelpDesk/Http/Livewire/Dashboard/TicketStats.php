<?php

namespace Modules\HelpDesk\Http\Livewire\Dashboard;

use Livewire\Component;
use Modules\HelpDesk\Entities\Ticket;

class TicketStats extends Component
{


    public function render()
    {
        $tma_hoje =  Ticket::whereBetween('ticket_open', [date('Y-m-d 00:00:00'), date('Y-m-d 23:59:59:59')])->avg('total_ticket');
        
        return view('helpdesk::livewire.dashboard.ticket-stats', 
    [   
        'tma_hoje' => $tma_hoje
    ]);
    }
}
