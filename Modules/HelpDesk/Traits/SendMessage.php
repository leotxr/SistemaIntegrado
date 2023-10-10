<?php

namespace Modules\HelpDesk\Traits;

use Modules\HelpDesk\Entities\TicketMessage;
use Modules\HelpDesk\Entities\Ticket;
use Illuminate\Support\Facades\Auth;


trait SendMessage {


    public function saveMessage(Ticket $ticket, $message)
    {
        $editing_ticket = $ticket;
        $ticket_message = new TicketMessage();
        $ticket_message->message = $message;
        $ticket_message->user_id = Auth::user()->id;
        $ticket_message->ticket_id = $editing_ticket->id;
        $ticket_message->read = 0;
        $ticket_message->save();
    }
}