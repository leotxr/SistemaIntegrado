<?php

namespace Modules\HelpDesk\Http\Livewire\Dashboard;

use DateTime;
use Livewire\Component;
use Modules\HelpDesk\Entities\Ticket;

class TicketStats extends Component
{
    public $tme_hoje;
    public $tme_ontem;
    public $tme_7d;
    public $tma_hoje;
    public $tma_ontem;
    public $tma_7d;

    protected $listeners = [
        'echo:dashboard,TicketCreated' => 'refreshMe',
        'echo:dashboard,TicketUpdated' => 'refreshMe',
    ];

    public function calculateTM()
    {
        $this->tme_hoje =  Ticket::whereBetween('ticket_open', [date('Y-m-d 00:00:00'), date('Y-m-d 23:59:59')])->whereNotNull('ticket_start')->avg('wait_time');
        $this->tme_ontem = Ticket::whereBetween('ticket_open', [date('Y-m-d 00:00:00', strtotime("-1 days")), date('Y-m-d 23:59:59', strtotime("-1 days"))])->whereNotNull('ticket_start')->avg('wait_time');
        $this->tme_7d = Ticket::whereBetween('ticket_open', [date('Y-m-d 00:00:00', strtotime("-6 days")), date('Y-m-d 23:59:59')])->whereNotNull('ticket_start')->avg('wait_time');

        $this->tma_hoje =  Ticket::whereBetween('ticket_open', [date('Y-m-d 00:00:00'), date('Y-m-d 23:59:59')])->whereNotNull('ticket_close')->avg('total_ticket');
        $this->tma_ontem = Ticket::whereBetween('ticket_open', [date('Y-m-d 00:00:00', strtotime("-1 days")), date('Y-m-d 23:59:59', strtotime("-1 days"))])->whereNotNull('ticket_close')->avg('total_ticket');
        $this->tma_7d = Ticket::whereBetween('ticket_open', [date('Y-m-d 00:00:00', strtotime("-6 days")), date('Y-m-d 23:59:59')])->whereNotNull('ticket_close')->avg('total_ticket');
    }

    public function mount()
    {
       $this->calculateTM();
       $this->render();
    }

    public function refreshMe()
    {
        $this->calculateTM();
        $this->render();
    }


    public function render()
    {

        return view('helpdesk::livewire.dashboard.ticket-stats');
    }
}
