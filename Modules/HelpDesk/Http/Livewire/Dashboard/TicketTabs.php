<?php

namespace Modules\HelpDesk\Http\Livewire\Dashboard;

use DateTime;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\HelpDesk\Entities\TicketPriority;
use Modules\HelpDesk\Entities\TicketStatus;
use Modules\HelpDesk\Entities\TicketMessage;
use Modules\HelpDesk\Entities\TicketPause;
use Modules\HelpDesk\Entities\TicketCategory;
use Modules\HelpDesk\Entities\TicketSubCategory;
use Modules\HelpDesk\Entities\Ticket;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class TicketTabs extends Component
{
    use WithPagination;

    public $subcategories = [];
    public $activeStatus = 1;
    public $modalTicket = false;
    public $modalFinish = false;
    public $modalPause = false;
    public $modalTransfer = false;
    public $modalDelete = false;
    public $modalEdit = false;
    public Ticket $showing;
    public Ticket $finishing;
    public Ticket $pausing;
    public Ticket $started;
    public Ticket $transfering;
    public Ticket $deleting;
    public Ticket $editing;
    public $message = '';
    public $ticket_close;
    public $total;
    public $users;
    public $user;
    public $ticketStatus = true;


    public $colors = ['black', '#f97316', '#22c55e', '#eab308', '#3b82f6'];


    protected $rules = [
        'finishing.ticket_start' => 'required',
        'ticket_close' => 'required',
        'finishing.ticket_start_pause' => 'required',
        'finishing.ticket_end_pause' => 'required',
        'finishing.total_pause' => 'required',
        'transfering.user_id' => 'required',
        'editing.category_id' => 'required',
        'editing.sub_category_id' => 'required',
        'editing.title' => 'required',
        'editing.description' => 'required'
    ];

    protected $listeners = ['echo:dashboard,TicketCreated' => 'render'];

    public function mount()
    {
        $this->ticket_close = now();
    }

    public function selectStatus($id)
    {
        $this->ticketStatus = true;
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
        $this->started = $ticket;

        if ($this->started->status_id == 1) {
            $this->started->status_id = 4;
            $this->started->ticket_start = date('Y-m-d H:i:s');
            $this->started->wait_time = $this->calcInterval(date('Y-m-d H:i:s'), $this->started->ticket_open);
            $this->started->user_id = Auth::user()->id;
            $this->message = 'Atendimento iniciado.';
            $this->sendMessage($ticket);
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
    }

    public function openFinishTicket(Ticket $ticket)
    {
        $this->modalFinish = true;
        $this->finishing = $ticket;
        $this->ticket_close = now();
    }

    public function calcInterval($date1, $date2)
    {
        $inicio = new DateTime($date1);
        $fim = new DateTime($date2);
        $diff = $inicio->diff($fim);
        $tempo = $diff->format("%H:%I:%S");

        return $tempo;
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
        $this->modalTicket = false;
        $this->message = '';
        $this->dispatchBrowserEvent(
            'notify',
            ['type' => 'success', 'message' => 'Chamado finalizado com sucesso!']
        );
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
            $this->dispatchBrowserEvent(
                'notify',
                ['type' => 'info', 'message' => 'Chamado Pausado']
            );
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
        $this->dispatchBrowserEvent(
            'notify',
            ['type' => 'success', 'message' => 'Status alterado para em atendimento!']
        );
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

        //$this->render();
        dd("chegou");
    }

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
        $this->sendMessage($this->transfering);
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
    }

    public function openEditTicket(Ticket $ticket)
    {
        $this->modalEdit = true;
        $this->editing = $ticket;
    }

    public function update()
    {
        //$this->validate();
        $this->editing->save();
        $this->message = "Chamado editado pelo usuário ".Auth::user()->name;
        $this->sendMessage($this->editing);
        $this->modalEdit = false;
        $this->modalTicket = false;
        $this->dispatchBrowserEvent(
            'notify',
            ['type' => 'info', 'message' => 'Chamado Editado com sucesso']
        );
    }

    public function openDeleteTicket(Ticket $ticket)
    {
        $this->modalDelete = true;
        $this->deleting = $ticket;
    }

    public function delete()
    {
        $delete = Ticket::where('id', $this->deleting->id)->delete();
        if ($delete) {
            return redirect()->route('helpdesk.index');
        }
    }
    public function render()
    {
        if (!empty($this->editing->category_id)) {
            $this->subcategories = TicketSubCategory::where('ticket_category_id', $this->editing->category_id)->get();
        }

        return view('helpdesk::livewire.dashboard.ticket-tabs', [
            'priorities' => TicketPriority::orderBy('order', 'desc')->get(),
            'statuses' => TicketStatus::whereNot('order', 0)->orderBy('order', 'asc')->get(),
            'tickets' => Ticket::join('ticket_categories', 'tickets.category_id', '=', 'ticket_categories.id')
                ->join('ticket_priorities', 'ticket_categories.priority_id', '=', 'ticket_priorities.id')
                ->where('tickets.status_id', $this->activeStatus)
                ->select('tickets.id', 'tickets.title', 'tickets.category_id', 'tickets.created_at', 'tickets.requester_id')
                ->orderBy('ticket_priorities.order', 'desc')
                ->paginate(5),
            'categories' => TicketCategory::all(),
            'my_tickets' => Ticket::join('ticket_categories', 'tickets.category_id', '=', 'ticket_categories.id')
                ->join('ticket_priorities', 'ticket_categories.priority_id', '=', 'ticket_priorities.id')
                ->where('user_id', Auth::user()->id)
                ->whereIn('status_id', [3,4])
                ->select('tickets.id', 'tickets.title', 'tickets.category_id', 'tickets.created_at', 'tickets.requester_id')
                ->orderBy('ticket_priorities.order', 'desc')
                ->paginate(5)
        ]);
    }
}
