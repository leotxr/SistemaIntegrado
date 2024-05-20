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
use App\Events\TicketUpdated;

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


    protected $listeners = [
        'echo:dashboard,TicketCreated' => 'render',
        'echo:dashboard,TicketUpdated' => '$refresh',
    ];

    public function selectStatus($id)
    {
        $this->ticketStatus = true;
        $status = TicketStatus::find($id);
        $this->activeStatus = $status->id;
    }

    public function callShow(Ticket $ticket)
    {
        $this->emit('TicketShow', $ticket->id);
    }

    public function callStart(Ticket $ticket)
    {
        $this->emit('TicketStart', $ticket->id);
    }

    public function callFinish(Ticket $ticket)
    {
        $this->emit('TicketFinish', $ticket->id);
    }

    public function calcInterval($date1, $date2)
    {
        $inicio = new DateTime($date1);
        $fim = new DateTime($date2);
        $diff = $inicio->diff($fim);
        $tempo = $diff->format("%H:%I:%S");

        return $tempo;
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

        return view('helpdesk::livewire.dashboard.ticket-tabs', [
            'priorities' => TicketPriority::orderBy('order', 'desc')->get(),
            'statuses' => TicketStatus::whereNot('order', 0)->orderBy('order', 'asc')->get(),
            'tickets' => Ticket::join('ticket_categories', 'tickets.category_id', '=', 'ticket_categories.id')
                ->join('ticket_priorities', 'ticket_categories.priority_id', '=', 'ticket_priorities.id')
                ->where(function ($query){
        if ($this->activeStatus == 1) $query->where('tickets.status_id', 1)->orWhere('tickets.user_id', NULL);
        else $query->where('tickets.status_id', $this->activeStatus);

    })
                ->select('tickets.id', 'tickets.title', 'tickets.category_id', 'tickets.created_at', 'tickets.requester_id')
                    ->orderBy('ticket_priorities.order', 'desc')
                    ->paginate(5),
            'categories' => TicketCategory::all(),
            'my_tickets' => Ticket::join('ticket_categories', 'tickets.category_id', '=', 'ticket_categories.id')
        ->join('ticket_priorities', 'ticket_categories.priority_id', '=', 'ticket_priorities.id')
        ->where('user_id', Auth::user()->id)
        ->whereIn('status_id', [3, 4])
        ->select('tickets.id', 'tickets.title', 'tickets.category_id', 'tickets.created_at', 'tickets.requester_id')
        ->orderBy('ticket_priorities.order', 'desc')
        ->paginate(5)
        ]);
    }
}
