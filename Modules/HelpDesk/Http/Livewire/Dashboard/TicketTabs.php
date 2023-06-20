<?php

namespace Modules\HelpDesk\Http\Livewire\Dashboard;

use DateTime;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\HelpDesk\Entities\TicketPriority;
use Modules\HelpDesk\Entities\TicketStatus;
use Modules\HelpDesk\Entities\TicketMessage;
use Modules\HelpDesk\Entities\TicketPause;
use Modules\HelpDesk\Entities\Ticket;
use Illuminate\Support\Facades\Auth;

class TicketTabs extends Component
{
    use WithPagination;

    public $activeStatus = 1;
    public $modalTicket = false;
    public $modalFinish = false;
    public $modalPause = false;
    public Ticket $showing;
    public Ticket $finishing;
    public Ticket $pausing;
    public $message = '';
    public $ticket_close;
    public $total;

    public $colors = ['black', '#f97316', '#22c55e', '#eab308', '#3b82f6'];


    protected $rules = [
        'finishing.ticket_start' => 'required',
        'ticket_close' => 'required',
        'finishing.ticket_start_pause' => 'required',
        'finishing.ticket_end_pause' => 'required',
        'finishing.total_pause' => 'required'
    ];

    protected $listeners = ['ticketCreated' => 'incrementTicketCount'];

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

        if (isset($this->showing->ticket_close)) {
            $inicio_atendimento = new DateTime($this->showing->ticket_start);
            $fim_atendimento = new DateTime($this->showing->ticket_close);
            $diff_atendimento = $inicio_atendimento->diff($fim_atendimento);
            $tempo_atendimento = $diff_atendimento->format("%H:%I:%S");

            $tempo_pausa = new DateTime($this->showing->total_pause);
            $atendimento = new DateTime($tempo_atendimento);
            $diff_pause = $atendimento->diff($tempo_pausa);
            $tempo_total = $diff_pause->format("%H:%I:%S");


            isset($this->showing->total_pause) ? $this->total = $tempo_total : $this->total = $tempo_atendimento;
        }
    }

    public function startTicket(Ticket $ticket)
    {
        $started = $ticket;
        if ($started->status_id == 1) {
            $started->status_id = 4;
            $started->ticket_start = date('Y-m-d H:i:s');
            $started->user_id = Auth::user()->id;
            $this->message = 'Atendimento iniciado.';
            $this->sendMessage($ticket);
            $started->save();
            $this->dispatchBrowserEvent('notify', 
            ['type' => 'success', 'message' =>'Status alterado para Em atendimento!']);
        } else {
            $this->dispatchBrowserEvent('notify', 
            ['type' => 'error', 'message' =>'Este chamado já está em atendimento!']);
        }
        $this->modalTicket = false;
    }

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
        $this->finishing->save();

        $ticket_message = new TicketMessage();
        $ticket_message->message = $this->message;
        $ticket_message->user_id = Auth::user()->id;
        $ticket_message->ticket_id = $this->finishing->id;
        $ticket_message->read = 0;
        $ticket_message->save();

        $this->modalFinish = false;
        $this->modalTicket = false;
        $this->message = '';
        $this->dispatchBrowserEvent('notify', 
        ['type' => 'success', 'message' =>'Chamado finalizado com sucesso!']);
    }

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
            $this->dispatchBrowserEvent('notify', 
            ['type' => 'info', 'message' =>'Chamado Pausado']);
        }

        $this->modalPause = false;
        $this->modalTicket = false;
        $this->message = '';
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
            $this->sendMessage($ticket);
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
            $total_pause = date('H:i:s', $end - $start);
            $teste = strtotime($total_pause) + strtotime($teste);
            $v = $v + $teste;
        }

        $this->pausing->total_pause = gmdate("H:i:s", $v);
        $this->pausing->save();


        $this->modalPause = false;
        $this->modalTicket = false;
        $this->dispatchBrowserEvent('notify', 
        ['type' => 'success', 'message' =>'Status alterado para em atendimento!']);
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

    public function incrementTicketCount()
    {
       $this->render();
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
                ->paginate(5)
        ]);
    }
}
