<?php

namespace Modules\HelpDesk\Http\Livewire\Components;

use Livewire\Component;
use Modules\HelpDesk\Entities\Ticket;
use Modules\HelpDesk\Entities\TicketMessage;
use Modules\HelpDesk\Traits\TicketActions;

class Chat extends Component
{
    use TicketActions;

    public Ticket $ticket;
    public $message = '';

    public function mount($ticket)
    {
        $this->ticket = $ticket;
    }

    public function sendMessage()
    {
        $this->saveMessage($this->ticket, $this->message);
        $this->reset('message');
    }


    public function render()
    {
        return view('helpdesk::livewire.components.chat', ['messages' => TicketMessage::where('ticket_id', $this->ticket->id)->latest()->take(10)->get()]);
    }
}
