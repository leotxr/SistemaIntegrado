<?php

namespace Modules\HelpDesk\Http\Livewire\Guest;

use Livewire\Component;
use Modules\HelpDesk\Entities\Ticket;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class MyTickets extends Component
{
    use WithPagination;


   public $colors = ['black', '#f97316', '#22c55e', '#eab308', '#3b82f6'];

    
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
