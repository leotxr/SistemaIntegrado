<?php

namespace Modules\HelpDesk\Http\Livewire\Dashboard;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\HelpDesk\Entities\TicketPriority;
use Modules\HelpDesk\Entities\TicketStatus;
use Modules\HelpDesk\Entities\TicketMessage;
use Modules\HelpDesk\Entities\Ticket;
use Illuminate\Support\Facades\Auth;

class TicketTabs extends Component
{
    use WithPagination;

    public $activeStatus = 1;
    public $modalTicket = false;
    public $modalFinish = false;
    public Ticket $showing;
    public Ticket $finishing;
    public $message = '';
    public $ticket_close;
    public $finish_message = '';

    public $colors = ['black', '#f97316', '#22c55e', '#eab308', '#3b82f6'];


    protected $rules = [
        'finishing.ticket_open' => 'required',
        'ticket_close' => 'required'
    ];

    public function mount()
    {
        $this->ticket_close = now();
    }


    public function selectStatus($id)
    {
        $status = TicketStatus::find($id);
        $this->activeStatus = $status->id;
    }

    public function showTicket(Ticket $ticket)
    {        
        $this->modalTicket = true;
        $this->showing = $ticket;
        
    }

    public function startTicket(Ticket $ticket)
    {
        $started = $ticket;
        if($started->status_id == 1)
        {
        $started->status_id = 4;
        $started->ticket_start = date('Y-m-d H:i:s');
        $started->user_id = Auth::user()->id;
        $message = new TicketMessage();
        $message->message = "Atendimento Iniciado";
        $message->user_id = Auth::user()->id;
        $message->read = 0;
        $message->ticket_id = $started->id;
        $message->save();
        $started->save();
        session()->flash('message', 'Status alterado para em atendimento');
        }else
        {
            session()->flash('message', 'Este chamado já foi atendido');
        }
        $this->modalTicket = false;
    }

    public function openFinishTicket(Ticket $ticket)
    {
        $this->modalFinish = true;
        $this->finishing = $ticket;
        $this->ticket_close = now();
    }

    public function sendMessage(Ticket $ticket)
    {
        $editing_ticket = $ticket;
        $ticket_message = new TicketMessage();
        $ticket_message->message = $this->message;
        $ticket_message->user_id = Auth::user()->id;
        $ticket_message->ticket_id = $editing_ticket->id;
        $ticket_message->read = 0;
        $ticket_message->save();
        $this->message = '';
    }

    public function render()
    {
        return view('helpdesk::livewire.dashboard.ticket-tabs', [
            'priorities' => TicketPriority::orderBy('order', 'desc')->get(),
            'statuses' => TicketStatus::orderBy('order', 'asc')->get(),
        'tickets' => Ticket::join('ticket_categories', 'tickets.category_id', '=', 'ticket_categories.id')
        ->join('ticket_priorities', 'ticket_categories.priority_id', '=', 'ticket_priorities.id')
        ->where('tickets.status_id', $this->activeStatus)
        ->select('tickets.id', 'tickets.title', 'tickets.category_id', 'tickets.created_at', 'tickets.requester_id')
        ->orderBy('ticket_priorities.order', 'desc')
        ->paginate(5)]);
    }
}
