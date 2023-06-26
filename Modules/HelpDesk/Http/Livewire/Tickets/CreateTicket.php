<?php

namespace Modules\HelpDesk\Http\Livewire\Tickets;

use DateTime;
use Livewire\Component;
use Modules\HelpDesk\Http\Livewire\Dashboard\TicketTabs;
use Modules\HelpDesk\Entities\TicketCategory;
use Modules\HelpDesk\Entities\TicketSubCategory;
use Modules\HelpDesk\Entities\Ticket;
use Modules\HelpDesk\Entities\TicketFile;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use App\Events\TicketCreated;
use Modules\HelpDesk\Notifications\NotifyTicketCreated;
use App\Models\User;
use Illuminate\Support\Facades\Notification;

class CreateTicket extends Component
{
    public $subcategories = [];
    public $hidden = false;
    public $ticket_files = [];
    public Ticket $saving;

    protected $rules = [
        'saving.category_id' => 'required',
        'saving.sub_category_id' => 'required',
        'saving.title' => 'required | max:191',
        'saving.description' => 'max:200',
        'saving.requester_id' => 'required',
        'ticket_files.*' => 'max:4096'
    ];


    public function mount()
    {
        $this->saving = new Ticket();
    }

    public function save()
    {
        $this->validate();
        $users = User::where('user_group_id', 9)->get();

        $this->saving->ticket_open = date('Y-m-d H:i:s');
        $this->saving->status_id = 1;
        $this->saving->save();

        foreach ($this->ticket_files as $file) {
            $path = $file->store('storage/helpdesk/' . $this->saving->id, ['disk' => 'my_files']);

            $ticket_file = new TicketFile();
            $ticket_file->url = $path;
            $ticket_file->user_id = Auth::user()->id;
            $ticket_file->ticket_id = $this->saving->id;
            $ticket_file->save();
        }

        //$user->notify(new NotifyTicketCreated($user));
        Notification::send($users, new NotifyTicketCreated(Auth::user(), $this->saving));
        TicketCreated::dispatch();

        return redirect()->to('/helpdesk/painel')->with('message', 'Chamado criado com sucesso!');
    }


    public function render()
    {
        if (!empty($this->saving->category_id)) {
            $this->subcategories = TicketSubCategory::where('ticket_category_id', $this->saving->category_id)->get();
        }
        return view('helpdesk::livewire.tickets.create-ticket', ['categories' => TicketCategory::all(),
    'requesters' => User::permission('abrir chamado')->orderBy('name', 'asc')->get()]);
    }
}
