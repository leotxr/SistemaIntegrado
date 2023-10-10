<?php

namespace Modules\HelpDesk\Traits;

use Modules\HelpDesk\Entities\TicketMessage;
use Modules\HelpDesk\Entities\TicketPause;
use Modules\HelpDesk\Entities\Ticket;
use Illuminate\Support\Facades\Auth;


trait TicketActions
{

    public function secToTime($seconds)
    {

        $days = floor($seconds / 86400);
        $hours = floor($seconds / 3600);
        $mins = floor($seconds / 60 % 60);
        $secs = floor($seconds % 60);

        $seconds >= 86400 ? $time = sprintf('%02d Dia(s) %02d:%02d:%02d', $days, $hours, $mins, $secs) : $time = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);

        return $time;
    }


    public function saveMessage(Ticket $ticket, $message)
    {
        $editing_ticket = $ticket;
        $ticket_message = new TicketMessage();
        $ticket_message->message = $message;
        $ticket_message->user_id = Auth::user()->id;
        $ticket_message->ticket_id = $editing_ticket->id;
        $ticket_message->read = 0;
        $ticket_message->save();
        return $ticket_message;
    }

    public function createPause(Ticket $ticket, $message)
    {
        $pause = TicketPause::create([
            'start_pause' => now(),
            'ticket_id' => $ticket->id,
            'user_id' => Auth::user()->id,
            'ticket_message_id' => $message->id ?? NULL
        ]);

        if ($pause) {
            $this->pausing->status_id = 3;
            $this->pausing->save();
            $this->dispatchBrowserEvent(
                'notify',
                ['type' => 'info', 'message' => 'Chamado Pausado']
            );
            return true;
        }
    }

    public function finishPause(Ticket $ticket)
    {
        $setPauseTime = TicketPause::whereNull('end_pause')
            ->where('ticket_id', $ticket->id)
            ->update(['end_pause' => now()]);



        if ($setPauseTime) {
            $ticket->status_id = 4;
            $message = 'Atendimento retomado.';
            $this->saveMessage($ticket, $message);
            if ($ticket === NULL)  $ticket->ticket_start = now();
            $ticket->save();
        }


        $pauses = TicketPause::whereNotNull('end_pause')
            ->where('ticket_id', $ticket->id)
            ->get();

        foreach ($pauses as $p) {
            
            $array_pauses[] = abs(strtotime($p->start_pause) - strtotime($p->end_pause));
        }
        $sum = array_sum($array_pauses);

        $ticket->total_pause = $sum;
        $ticket->user_id = Auth::user()->id;
        if ($ticket->save()) return true;
        else return false;
    }

}