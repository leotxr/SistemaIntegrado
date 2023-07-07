<?php

namespace Modules\HelpDesk\Http\Livewire\Tickets\Crud;

use Livewire\Component;
use Modules\HelpDesk\Entities\Ticket;
use Modules\HelpDesk\Entities\TicketMessage;
use Modules\HelpDesk\Entities\TicketSubCategory;
use App\Events\TicketUpdated;
use Illuminate\Support\Facades\Auth;
use DateTime;

class FinishTicket extends Component
{

    public $modalFinish = false;
    public $modalTicket;
    public $message;
    public Ticket $finishing;
    public DateTime $ticket_close;

    protected $rules = [
        'finishing.ticket_start' => 'required',
        'ticket_close' => 'required',
        'finishing.ticket_start_pause' => 'required',
        'finishing.ticket_end_pause' => 'required',
        'finishing.total_pause' => 'required',
    ];

    protected $listeners = [
        'TicketFinish' => 'openFinishTicket',
        'echo:dashboard,TicketUpdated' => '$refresh',
    ];



    public function openFinishTicket(Ticket $ticket)
    {
        $this->modalFinish = true;
        $this->finishing = $ticket;
        $this->ticket_close = now();
        
    }

    public function finish()
    {
        //$this->validate();
        $this->finishing->ticket_close = $this->ticket_close;
        $this->finishing->status_id = 2;
        if ($this->finishing->total_pause) {
            $total_at = $this->calcInterval($this->finishing->ticket_start, $this->finishing->ticket_close);
            $pausa = $this->finishing->total_pause;

            $total = $this->calcInterval($total_at, $pausa);

            $this->finishing->total_ticket = $total;
        } else $this->finishing->total_ticket = $this->calcInterval($this->finishing->ticket_start, $this->finishing->ticket_close);
        $this->finishing->save();

        $ticket_message = new TicketMessage();
        $ticket_message->message = $this->message;
        $ticket_message->user_id = Auth::user()->id;
        $ticket_message->ticket_id = $this->finishing->id;
        $ticket_message->read = 0;
        $ticket_message->save();

        $this->modalFinish = false;
        $this->message = '';
        $this->dispatchBrowserEvent(
            'notify',
            ['type' => 'success', 'message' => 'Chamado finalizado com sucesso!']
        );

        TicketUpdated::dispatch();
    }

    public function calcInterval($date1, $date2)
    {
        $inicio = new DateTime($date1);
        $fim = new DateTime($date2);
        $diff = $inicio->diff($fim);
        $tempo = $diff->format("%H:%I:%S");

        return $tempo;
    }

    public function render()
    {
        return view('helpdesk::livewire.tickets.crud.finish-ticket');
    }
}
