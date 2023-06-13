<?php

namespace Modules\HelpDesk\Http\Livewire\Settings;

use Livewire\Component;
use Modules\HelpDesk\Entities\TicketCategory;
use Modules\HelpDesk\Entities\TicketPriority;

class FormCategory extends Component
{
    public TicketCategory $ticketCategory;
    public TicketCategory $editingCategory;
    public $selectCategory = 1;

    public function mount()
    {
        $this->ticketCategory = new TicketCategory();
    }

    protected $rules = [

        'ticketCategory.name' => 'required | string',
        'ticketCategory.description' => 'max:100',
        'ticketCategory.order' => 'integer',
        'ticketCategory.priority_id' => 'required',
        'editingCategory.id' => 'integer',
        'editingCategory.name' => 'string',
        'editingCategory.description' => 'max:100',
        'editingCategory.order' => 'integer',
        'editingCategory.priority_id' => 'integer',

    ];

    public function save()
    {
        
        $this->validate();
        $this->ticketCategory->save();
        
        return redirect()->to('/helpdesk/configuracoes/categorias')->with('message', 'Categoria criada com sucesso!');
    }

    public function update()
    {
        //$this->validate();
        $this->editingCategory->save();
        return redirect()->to('/helpdesk/configuracoes/categorias')->with('update_message', 'Categoria atualizada com sucesso!');
    }

    public function render()
    {
        $this->editingCategory = TicketCategory::find($this->selectCategory);
        return view('helpdesk::livewire.settings.form-category', [
            'categories' => Ticketcategory::orderBy('order')->paginate(10),
            'priorities' => TicketPriority::orderBy('order')->get(),]);
    }
}
