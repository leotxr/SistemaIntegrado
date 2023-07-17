<?php

namespace Modules\HelpDesk\Http\Livewire\Tickets\Crud;

use Livewire\Component;
use Modules\HelpDesk\Entities\Ticket;
use Modules\HelpDesk\Entities\TicketMessage;
use Modules\HelpDesk\Entities\TicketPause;
use Illuminate\Support\Facades\Auth;
use App\Events\TicketUpdated;
use DateTime;

class PauseTicket extends Component
{

    public $modalTicket = true;
    public $modalPause = false;
    public $message;
    public Ticket $pausing;


    protected $listeners = [
        'TicketPause' => 'openPauseTicket',
        'TicketEndPause' => 'endPause',
        'echo:dashboard,TicketUpdated' => '$refresh',
    ];

    public function openPauseTicket(Ticket $ticket)
    {
        $this->modalPause = true;
        $this->pausing = $ticket;
    }

    public function pause()
    {

        $ticket_message = TicketMessage::create([
            'message' => $this->message,
            'user_id' => Auth::user()->id,
            'ticket_id' => $this->pausing->id,
            'read' => 0
        ]);
        $pause = TicketPause::create([
            'start_pause' => now(),
            'ticket_id' => $this->pausing->id,
            'user_id' => Auth::user()->id,
            'ticket_message_id' => $ticket_message->id ?? NULL
        ]);

        if ($pause) {
            $this->pausing->status_id = 3;
            $this->pausing->save();
            $this->dispatchBrowserEvent(
                'notify',
                ['type' => 'info', 'message' => 'Chamado Pausado']
            );
        }

        $this->modalPause = false;
        $this->modalTicket = false;
        $this->message = '';

        TicketUpdated::dispatch();
    }

    public function endPause(Ticket $ticket)
    {

        $this->pausing = $ticket;
        $pause_table = TicketPause::whereNull('end_pause')
            ->where('ticket_id', $this->pausing->id)
            ->update(['end_pause' => now()]);

        if ($pause_table) {
            $this->pausing->status_id = 4;
            $this->message = 'Atendimento retomado.';
            $this->sendMessage($ticket, $this->message);
            if ($this->pausing->ticket_start === NULL)  $this->pausing->ticket_start = now();
            $this->pausing->save();
        }

        $pauses = TicketPause::whereNotNull('end_pause')
            ->where('ticket_id', $this->pausing->id)
            ->get();

        $teste = 0;
        $v = 0;
        foreach ($pauses as $p) {
            $start = strtotime($p->start_pause);
            $end = strtotime($p->end_pause);
            //$total_pause = date('H:i:s', $end - $start);
            //$teste = strtotime($total_pause) + strtotime($teste);
            //$v = $v + $teste;
            //$pause = $this->calcInterval($p->start_pause, $p->end_pause);
            //$t = gmdate($pause);

            $seconds = abs($end - $start);
            $hours = floor($seconds / 3600);
            $mins = floor($seconds / 60 % 60);
            $secs = floor($seconds % 60);
            $pause = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);
        }
        //dd($pause);

        $this->pausing->total_pause = $pause;
        $this->pausing->save();


        $this->modalPause = false;
        $this->modalTicket = false;
        $this->dispatchBrowserEvent(
            'notify',
            ['type' => 'success', 'message' => 'Status alterado para em atendimento!']
        );

        TicketUpdated::dispatch();
    }

    public function calcInterval($date1, $date2)
    {
        $inicio = new DateTime($date1);
        $fim = new DateTime($date2);
        $diff = $inicio->diff($fim);
        //$tempo = $diff->format("%H:%I:%S");

        return $diff;
    }


    public function sendMessage(Ticket $ticket, $message)
    {
        $editing_ticket = $ticket;
        $ticket_message = new TicketMessage();
        $ticket_message->message = $message;
        $ticket_message->user_id = Auth::user()->id;
        $ticket_message->ticket_id = $editing_ticket->id;
        $ticket_message->read = 0;
        $ticket_message->save();
        $this->message = '';
    }

    public function render()
    {
        return view('helpdesk::livewire.tickets.crud.pause-ticket');
    }
}
