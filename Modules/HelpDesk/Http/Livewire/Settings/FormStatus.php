<?php

namespace Modules\HelpDesk\Http\Livewire\Settings;

use Livewire\Component;
use Modules\HelpDesk\Entities\TicketStatus;

class FormStatus extends Component
{
    public TicketStatus $TicketStatus;
    public TicketStatus $editingTicketStatus;

    protected $rules = [

        'TicketStatus.name' => 'required | string',
        'TicketStatus.description' => 'max:100',
        'TicketStatus.order' => 'integer',
        'editingTicketStatus.id' => 'integer',
        'editingTicketStatus.name' => 'string',
        'editingTicketStatus.description' => 'max:100',
        'editingTicketStatus.order' => 'integer',

    ];

    public function mount()
    {
        $this->TicketStatus = new TicketStatus();
    }


    public function save()
    {
        $this->validate();
        $this->TicketStatus->save();
        return redirect()->to('/helpdesk/painel/configuracoes/status')->with('message', 'Status criado com sucesso!');
    }
    public function render()
    {
        return view('helpdesk::livewire.settings.form-status',
    [
        'ticketstatuses' => TicketStatus::paginate(10),
    ]);
    }
}
