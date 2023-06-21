<?php

namespace Modules\HelpDesk\Http\Livewire\Guest;

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

class FormCreate extends Component
{
    use WithFileUploads;

    public $ticket_files = [];
    public $hidden = false;
    public $category;
    public $subcategories = [];
    public Ticket $saving;

    protected $rules = [
        'saving.category_id' => 'required',
        'saving.sub_category_id' => 'required',
        'saving.title' => 'required | max:191',
        'saving.description' => 'max:200',
        'ticket_files.*' => 'max:4096'
    ];


    public function mount()
    {
        $this->saving = new Ticket();
    }

    public function save()
    {
        $this->validate();

        $this->saving->requester_id = Auth::user()->id;
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

        TicketCreated::dispatch();

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
