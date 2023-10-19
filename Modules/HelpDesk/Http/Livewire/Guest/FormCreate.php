<?php

namespace Modules\HelpDesk\Http\Livewire\Guest;

use DateTime;
use Livewire\Component;
use Modules\HelpDesk\Http\Livewire\Dashboard\TicketTabs;
use Modules\HelpDesk\Entities\TicketCategory;
use Modules\HelpDesk\Entities\TicketSubCategory;
use Modules\HelpDesk\Entities\Ticket;
use Modules\HelpDesk\Entities\TicketFile;
use Modules\HelpDesk\Entities\TicketPause;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use App\Events\TicketCreated;
use Modules\HelpDesk\Notifications\NotifyTicketCreated;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use Modules\HelpDesk\Entities\TicketMessage;
use Modules\HelpDesk\Traits\TicketActions;

class FormCreate extends Component
{
    use WithFileUploads;
    use TicketActions;

    public $ticket_files = [];
    public $hidden = false;
    public $category;
    public $subcategories = [];
    public Ticket $saving;
    public $message = '';

    protected $rules = [
        'saving.category_id' => 'required',
        'saving.sub_category_id' => 'required',
        'saving.title' => 'required | max:191',
        'saving.description' => 'required',
        'ticket_files.*' => 'max:4096'
    ];


    public function mount()
    {
        $this->saving = new Ticket();
    }

    public function checkTime(Ticket $ticket, $time)
    {

        if ($this->outOfService($ticket, $time)) {
            $ticket->status_id = 3;
            $ticket->save();
            $message = "Chamado aberto fora do horário de atendimento.";
            $generated_message = $this->saveMessage($ticket, $message);
            $this->createPause($ticket, $generated_message);
        } else {
            $ticket->status_id = 1;
            $ticket->save();
        }
    }

    public function save()
    {
        $this->validate();
        $users = User::where('user_group_id', 9)->get();

        $this->saving->requester_id = Auth::user()->id;
        $this->saving->ticket_open = date('Y-m-d H:i:s');
        $this->checkTime($this->saving, date('Y-m-d H:i:s'));


        foreach ($this->ticket_files as $file) {
            $path = $file->store('storage/helpdesk/' . $this->saving->id, ['disk' => 'my_files']);

            $ticket_file = new TicketFile();
            $ticket_file->url = $path;
            $ticket_file->user_id = Auth::user()->id;
            $ticket_file->ticket_id = $this->saving->id;
            $ticket_file->save();
        };
        $this->saving->save();

        TicketCreated::dispatch(Auth::user(), $this->saving);
        Notification::send($users, new NotifyTicketCreated(Auth::user(), $this->saving));

        return redirect()->to('/helpdesk/chamados')->with('message', 'Chamado criado com sucesso!');
    }

    public function render()
    {
        if (!empty($this->saving->category_id)) {
            $this->subcategories = TicketSubCategory::where('ticket_category_id', $this->saving->category_id)->get();
        }

        return view('helpdesk::livewire.guest.form-create', ['categories' => TicketCategory::all()]);
    }
}
