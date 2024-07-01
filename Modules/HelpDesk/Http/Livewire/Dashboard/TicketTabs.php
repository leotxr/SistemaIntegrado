<?php

namespace Modules\HelpDesk\Http\Livewire\Dashboard;

use DateTime;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\HelpDesk\Entities\ExtraService;
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
    public Ticket $editing;
    public $message = '';
    public $ticket_close;
    public $total;
    public $users;
    public $user;
    public $ticketStatus = true;


    public $colors = ['black', '#f97316', '#22c55e', '#eab308', '#3b82f6'];


    protected $listeners = [
        'echo:dashboard,TicketCreated' => '$refresh',
        'echo:dashboard,TicketUpdated' => '$refresh',
    ];

    public function selectStatus($id)
    {
        $this->ticketStatus = true;
        $status = TicketStatus::find($id);
        $this->activeStatus = $status->id;
    }

    public function callShow(Ticket $ticket): void
    {
        $this->emit('TicketShow', $ticket->id);
    }

    public function callStart(Ticket $ticket): void
    {
        $this->emit('TicketStart', $ticket->id);
    }

    public function callFinish(Ticket $ticket): void
    {
        $this->emit('TicketFinish', $ticket->id);
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
                ->where(function ($query) {
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
                ->paginate(5),
            'extra_services' => ExtraService::where('status_id', 1)->where('is_ticket', 0)->get()
        ]);
    }
}
