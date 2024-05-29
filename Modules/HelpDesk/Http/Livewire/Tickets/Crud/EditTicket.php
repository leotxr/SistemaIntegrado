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
use App\Models\User;
use Modules\HelpDesk\Traits\TicketActions;

class EditTicket extends Component
{

    use TicketActions;

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
        'editing.description' => 'required',
        'editing.ticket_open' => 'required',
        'editing.ticket_start' => 'max:255',
        'editing.requester_id' => 'required'
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
            $this->started->wait_time = abs(strtotime(now()) - strtotime($this->started->ticket_open));
            $this->started->user_id = Auth::user()->id;
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
        $this->saveMessage($this->editing, $this->message);
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
        $this->message = "Chamado reaberto pelo usuário " . Auth::user()->name;
        $this->saveMessage($this->reopening, $this->message);
    }

    public function render()
    {
        if (!empty($this->editing->category_id)) {
            $this->subcategories = TicketSubCategory::where('ticket_category_id', $this->editing->category_id)->get();
        }
        return view(
            'helpdesk::livewire.tickets.crud.edit-ticket',
            ['categories' => TicketCategory::all(),
                'requesters' => User::all()]
        );
    }
}
