<?php

namespace Modules\HelpDesk\Http\Livewire\Tickets\Crud;

use Livewire\Component;
use Modules\HelpDesk\Entities\Ticket;
use Modules\HelpDesk\Entities\TicketCategory;
use Modules\HelpDesk\Entities\TicketSubCategory;
use App\Events\TicketUpdated;


class EditTicket extends Component
{

    public $modalEdit = false;
    public $subcategories;
    public $colors = ['black', '#f97316', '#22c55e', '#eab308', '#3b82f6'];
    public Ticket $editing;

    protected $rules = [
        'editing.category_id' => 'required',
        'editing.sub_category_id' => 'required',
        'editing.title' => 'required',
        'editing.description' => 'required'
    ];

    protected $listeners = [
        'TicketEdit' => 'edit'
    ];

    public function edit(Ticket $ticket)
    {
        $this->modalEdit = true;
        $this->editing = $ticket;
    }

    public function update()
    {
        $this->validate();
        $this->editing->save();
        //$this->message = "Chamado editado pelo usuário " . Auth::user()->name;
        //$this->sendMessage($this->editing, $this->message);
        $this->modalEdit = false;
        $this->dispatchBrowserEvent(
            'notify',
            ['type' => 'info', 'message' => 'Chamado Editado com sucesso']
        );

        TicketUpdated::dispatch();
    }

    public function render()
    {
        if (!empty($this->editing->category_id)) {
            $this->subcategories = TicketSubCategory::where('ticket_category_id', $this->editing->category_id)->get();
        }
        return view(
            'helpdesk::livewire.tickets.crud.edit-ticket',
            ['categories' => TicketCategory::all()]
        );
    }
}
