<?php

namespace Modules\HelpDesk\Http\Livewire\Tickets\Crud;


use Livewire\Component;
use Modules\HelpDesk\Entities\TicketMessage;
use Modules\HelpDesk\Entities\TicketPause;
use Modules\HelpDesk\Entities\Ticket;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use App\Events\TicketUpdated;
use Modules\HelpDesk\Traits\TicketActions;

class TransferTicket extends Component
{
    use TicketActions;

    public $users;
    public $user;
    public Ticket $transfering;
    public $modalTransfer = false;
    public $message;

    protected $rules = [
        'transfering.user_id' => 'required',
    ];

    protected $listeners = [
        'TicketTransfer' => 'openTransferTicket'
    ];

    public function openTransferTicket(Ticket $ticket)
    {
        $this->users = User::where('user_group_id', 9)->get();
        $this->modalTransfer = true;
        $this->transfering = $ticket;
    }

    public function transfer()
    {

        $novo = User::find($this->transfering->user_id);
        $this->message = "Chamado transferido para o usuário $novo->name.";
        $this->saveMessage($this->transfering, $this->message);
        $pause = TicketPause::create([
            'start_pause' => now(),
            'ticket_id' => $this->transfering->id,
            'user_id' => Auth::user()->id
        ]);

        if ($pause) {
            $this->transfering->status_id = 3;
            $this->transfering->save();
            $this->dispatchBrowserEvent(
                'notify',
                ['type' => 'info', 'message' => 'Chamado Pausado']
            );
        }
        $this->modalTransfer = false;

        TicketUpdated::dispatch();
    }


    public function render()
    {
        return view('helpdesk::livewire.tickets.crud.transfer-ticket');
    }
}
