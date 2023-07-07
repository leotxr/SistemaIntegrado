<?php

namespace Modules\HelpDesk\Http\Livewire\Tickets\Crud;

use Livewire\Component;
use Modules\HelpDesk\Entities\Ticket;
use Modules\HelpDesk\Entities\TicketCategory;
use Modules\HelpDesk\Entities\TicketMessage;
use Modules\HelpDesk\Entities\TicketSubCategory;
use Modules\HelpDesk\Entities\TicketPause;
use App\Events\TicketUpdated;
use Illuminate\Support\Facades\Auth;
use DateTime;

class EditTicket extends Component
{

    public $modalTicket = true;
    public $modalEdit = false;
    public $modalFinish = false;
    public $modalReopen = false;
    public $ticket_close;
    public $subcategories;
    public $colors = ['black', '#f97316', '#22c55e', '#eab308', '#3b82f6'];
    public Ticket $editing;
    public Ticket $started;
    public Ticket $finishing;
    public Ticket $reopening;
    public $message;

    protected $rules = [
        'editing.category_id' => 'required',
        'editing.sub_category_id' => 'required',
        'editing.title' => 'required',
        'editing.description' => 'required'
    ];

    protected $listeners = [
        'TicketEdit' => 'edit',
        'TicketStart' => 'start',
        'echo:dashboard,TicketUpdated' => '$refresh',
        'TicketReopen' => 'confirmReopen'
    ];


    public function start(Ticket $ticket)
    {
        $this->started = $ticket;

        if ($this->started->status_id == 1) {
            $this->started->status_id = 4;
            $this->started->ticket_start = date('Y-m-d H:i:s');
            $this->started->wait_time = $this->calcInterval(date('Y-m-d H:i:s'), $this->started->ticket_open);
            $this->started->user_id = Auth::user()->id;
            //$this->message = 'Atendimento iniciado.';
            //$this->sendMessage($ticket, $this->message);
            $this->started->save();
            $this->dispatchBrowserEvent(
                'notify',
                ['type' => 'success', 'message' => 'Status alterado para Em atendimento!']
            );
        } else {
            $this->dispatchBrowserEvent(
                'notify',
                ['type' => 'error', 'message' => 'Este chamado já está em atendimento!']
            );
        }
        $this->modalTicket = false;

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

    public function edit(Ticket $ticket)
    {
        $this->modalEdit = true;
        $this->editing = $ticket;
    }

    public function update()
    {
        $this->validate();
        $this->editing->save();
        $this->message = "Chamado editado pelo usuário " . Auth::user()->name;
        $this->sendMessage($this->editing, $this->message);
        $this->modalEdit = false;
        $this->dispatchBrowserEvent(
            'notify',
            ['type' => 'info', 'message' => 'Chamado Editado com sucesso']
        );

        TicketUpdated::dispatch();
    }

    public function confirmReopen(Ticket $ticket)
    {
        $this->modalReopen = true;
        $this->reopening = $ticket;
    }

    public function setNull(Ticket $ticket)
    {
        $update = Ticket::where('id', $ticket->id)
            ->update([
                'ticket_start' => null,
                'ticket_close' => null,
                'status_id' => 1,
                'total_pause' => null,
                'total_ticket' => null,
                'wait_time' => null,
                'ticket_open' => now()
            ]);

        if ($update) {
            $delete_pause = TicketPause::where('ticket_id', $ticket->id)->delete();
            $this->modalReopen = false;
            $this->modalTicket = false;
            $this->dispatchBrowserEvent(
                'notify',
                ['type' => 'info', 'message' => 'Chamado reaberto! Verifique o painel.']
            );
            TicketUpdated::dispatch();
        } else {
            $this->dispatchBrowserEvent(
                'notify',
                ['type' => 'error', 'message' => 'Ocorreu um erro ao reabrir o chamado.']
            );
        }
    }

    public function reopen()
    {
        $this->setNull($this->reopening);
        $this->message = "Chamado reaberto pelo usuário ".Auth::user()->name;
        $this->sendMessage($this->reopening, $this->message);   


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
        if (!empty($this->editing->category_id)) {
            $this->subcategories = TicketSubCategory::where('ticket_category_id', $this->editing->category_id)->get();
        }
        return view(
            'helpdesk::livewire.tickets.crud.edit-ticket',
            ['categories' => TicketCategory::all()]
        );
    }
}
