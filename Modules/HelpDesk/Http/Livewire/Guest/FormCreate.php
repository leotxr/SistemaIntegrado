<?php

namespace Modules\HelpDesk\Http\Livewire\Guest;

use DateTime;
use Livewire\Component;
use Modules\HelpDesk\Entities\TicketCategory;
use Modules\HelpDesk\Entities\TicketSubCategory;
use Modules\HelpDesk\Entities\Ticket;
use Illuminate\Support\Facades\Auth;


class FormCreate extends Component
{
    public $hidden = false;
    public $category;
    public $subcategories = [];
    public Ticket $saving;

    protected $rules = [
        'saving.category_id' => 'required',
        'saving.sub_category_id' => 'required',
        'saving.title' => 'required | max:191',
        'saving.description' => 'max:200',
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
        
        return redirect()->to('/helpdesk/chamados')->with('message', 'Chamado criado com sucesso!');
    }


    public function render()
    {
        if(!empty($this->saving->category_id))
        {
            $this->subcategories = TicketSubCategory::where('ticket_category_id', $this->saving->category_id)->get();
        }
        
        return view('helpdesk::livewire.guest.form-create', ['categories' => TicketCategory::all()]);
    }
}
