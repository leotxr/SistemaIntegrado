<?php

namespace Modules\HelpDesk\Http\Livewire\Tickets;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\HelpDesk\Entities\Ticket;
use DateTime;
use Modules\HelpDesk\Http\Livewire\Dashboard\TicketTabs;
use Illuminate\Support\Facades\Auth;
use Modules\HelpDesk\Entities\TicketPause;
use App\Events\TicketCreated;

class AllTickets extends Component
{
    use WithPagination;

    public $sortField = 'tickets.id';
    public $sortDirection = 'desc';
    public $search = '';
    public Ticket $showing;
    public $modalTicket = false;
    public $total;
    public Ticket $reopening;
    public $modalReopen = false;
    public $message = '';

    public function sortBy($field)
    {

        $this->sortDirection = $this->sortField === $field
            ? $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc'
            : 'asc';

        $this->sortField = $field;
    }

    public $colors = ['black', '#f97316', '#22c55e', '#eab308', '#3b82f6'];

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
            TicketCreated::dispatch();
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
        $ticket_tabs = new TicketTabs;
        $ticket_tabs->sendMessage($this->reopening, $this->message);   


    }


    public function render()
    {
        return view(
            'helpdesk::livewire.tickets.all-tickets',
            [
                'tickets' => Ticket::whereNotNull('ticket_close')->search($this->sortField, $this->search)->orderBy($this->sortField, $this->sortDirection)->paginate(10)
            ]
        );
    }
}
