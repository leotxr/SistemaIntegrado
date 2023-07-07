<?php

namespace Modules\HelpDesk\Http\Livewire\Tickets\Crud;

use Livewire\Component;
use Modules\HelpDesk\Entities\Ticket;
use App\Events\TicketDeleted;

class DeleteTicket extends Component
{

    public $modalDelete = false;
    public $subcategories;
    public $colors = ['black', '#f97316', '#22c55e', '#eab308', '#3b82f6'];
    public Ticket $deleting;

    protected $listeners = [
        'TicketDelete' => 'openDeleteTicket'
    ];

    public function openDeleteTicket(Ticket $ticket)
    {
        $this->modalDelete = true;
        $this->deleting = $ticket;
    }

    public function delete()
    {
        $delete = Ticket::where('id', $this->deleting->id)->delete();
        if ($delete) {
            return redirect()->route('helpdesk.index');
        }

        TicketDeleted::dispatch();
    }

    public function render()
    {
        return view('helpdesk::livewire.tickets.crud.delete-ticket');
    }
}
