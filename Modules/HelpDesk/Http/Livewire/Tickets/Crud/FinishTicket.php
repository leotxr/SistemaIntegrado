<?php

namespace Modules\HelpDesk\Http\Livewire\Tickets\Crud;

use App\Http\Livewire\Components\Quill;
use App\Http\Livewire\Components\Trix;
use Livewire\Component;
use Modules\HelpDesk\Entities\Ticket;
use Modules\HelpDesk\Entities\TicketMessage;
use Modules\HelpDesk\Entities\TicketSubCategory;
use App\Events\TicketUpdated;
use Illuminate\Support\Facades\Auth;
use DateTime;
use Modules\HelpDesk\Notifications\NotifyTicketFinished;
use Illuminate\Support\Facades\Notification;
use App\Models\User;
use Modules\HelpDesk\Traits\TicketActions;

class FinishTicket extends Component
{
    use TicketActions;

    public $modalFinish = false;
    public $modalTicket;
    public $message;
    public Ticket $finishing;
    public $ticket_close;

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
        Trix::EVENT_VALUE_UPDATED
    ];

    public function trix_value_updated($value){
        $this->message = $value;
    }


    public function openFinishTicket(Ticket $ticket)
    {
        $this->finishing = $ticket;
        $this->ticket_close = now()->format('Y-m-d H:i:s');
        $this->modalFinish = true;
    }

    public function finish()
    {
        //dd($this->message);
        //dd($this->ticket_close);
        //$this->validate();
        $this->finishing->ticket_close = $this->ticket_close;
        $this->finishing->status_id = 2;
        if ($this->finishing->total_pause) {
            $total_at = abs(strtotime($this->finishing->ticket_close) - strtotime($this->finishing->ticket_start));
            $pausa = $this->finishing->total_pause;
            $tot = abs($pausa - $total_at);

            $this->finishing->total_ticket = $tot;
        } else $this->finishing->total_ticket = abs(strtotime($this->finishing->ticket_close) - strtotime($this->finishing->ticket_start));


        $this->finishing->save();
        $this->saveMessage($this->finishing, $this->message);
        //$this->reset('message');
        $this->modalFinish = false;
        $this->dispatchBrowserEvent(
            'notify',
            ['type' => 'success', 'message' => 'Chamado finalizado com sucesso!']
        );

        TicketUpdated::dispatch();
        Notification::send(User::find($this->finishing->requester_id), new NotifyTicketFinished(User::find($this->finishing->requester_id), $this->finishing));
    }


    public function render()
    {
        return view('helpdesk::livewire.tickets.crud.finish-ticket');
    }
}
