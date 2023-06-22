<?php

namespace Modules\HelpDesk\Http\Livewire\Tickets;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\HelpDesk\Entities\Ticket;
use DateTime;

class AllTickets extends Component
{
    use WithPagination;

    public $sortField = 'tickets.id';
    public $sortDirection = 'desc';
    public $search = '';
    public Ticket $showing;
    public $modalTicket = false;
    public $total;

    public function sortBy($field)
    {

        $this->sortDirection = $this->sortField === $field
            ? $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc'
            : 'asc';

        $this->sortField = $field;
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

    public function render()
    {
        return view('helpdesk::livewire.tickets.all-tickets',
    [
        'tickets' => Ticket::search($this->sortField, $this->search)->orderBy($this->sortField, $this->sortDirection)->paginate(10)
    ]);
    }
}
