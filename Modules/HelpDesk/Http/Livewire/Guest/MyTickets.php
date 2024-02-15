<?php

namespace Modules\HelpDesk\Http\Livewire\Guest;

use Livewire\Component;
use Modules\HelpDesk\Entities\Ticket;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Modules\HelpDesk\http\Livewire\Dashboard\TicketTabs;

class MyTickets extends Component
{
    use WithPagination;


   public $colors = ['black', '#f97316', '#22c55e', '#eab308', '#3b82f6'];
   public $tab = 'ativos';

   public function emitTeste()
   {

       $this->emitTo('helpdesk::dashboard.ticket-tabs', 'ticketCreated');
   }


    public function render()
    {
        return view('helpdesk::livewire.guest.my-tickets', [
            'tickets' => Ticket::whereNotIn('status_id', [2])
            ->where('requester_id', Auth::user()->id)
            ->paginate(10),
            'closed' => Ticket::where('status_id', 2)
            ->where('requester_id', Auth::user()->id)
            ->paginate(10)]);
    }
}
