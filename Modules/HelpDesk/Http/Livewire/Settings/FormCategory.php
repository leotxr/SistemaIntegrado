<?php

namespace Modules\HelpDesk\Http\Livewire\Settings;

use Livewire\Component;
use Modules\HelpDesk\Entities\TicketCategory;

class FormCategory extends Component
{
    public TicketCategory $ticketCategory;
    public TicketCategory $editingCategory;
    public $selectCategory = 1;

    public function mount()
    {
        $this->ticketCategory = new TicketCategory();
    }

    public $rules = [

        'ticketCategory.name' => 'required | string',
        'ticketCategory.description' => 'max:100',
        'ticketCategory.order' => 'integer',
        'editingCategory.id' => 'integer',
        'editingCategory.name' => 'required | string',
        'editingCategory.description' => 'max:100',
        'editingCategory.order' => 'integer',

    ];

    public function save()
    {
        $this->validate();
        $this->ticketCategory->save();
        session()->flash('message', 'Categoria criada com sucesso.');
    }

    public function update()
    {
        //$this->validate();
        $this->editingCategory->save();
        session()->flash('update_message', 'Categoria atualizada com sucesso.');
    }

    public function render()
    {
        $this->editingCategory = TicketCategory::find($this->selectCategory);
        return view('helpdesk::livewire.settings.form-category', ['categories' => Ticketcategory::orderBy('order')->get()]);
    }
}
