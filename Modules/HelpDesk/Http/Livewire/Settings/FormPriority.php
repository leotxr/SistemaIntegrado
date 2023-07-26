<?php

namespace Modules\HelpDesk\Http\Livewire\Settings;

use Livewire\Component;
use Modules\HelpDesk\Entities\TicketPriority;

class FormPriority extends Component
{

    public TicketPriority $priority;
    public TicketPriority $editingPriority;

    protected $rules = [

        'priority.name' => 'required | string',
        'priority.description' => 'max:100',
        'priority.order' => 'integer',
        'editingPriority.id' => 'integer',
        'editingPriority.name' => 'string',
        'editingPriority.description' => 'max:100',
        'editingPriority.order' => 'integer',

    ];

    public function mount()
    {
        $this->priority = new TicketPriority();
    }


    public function save()
    {
        $this->validate();
        $this->priority->save();
        return redirect()->to('/helpdesk/painel/configuracoes/prioridades')->with('message', 'Prioridade criada com sucesso!');
    }


    public function render()
    {
        return view('helpdesk::livewire.settings.form-priority',[
            'priorities' => TicketPriority::paginate(10)
        ]);
    }
}
