<?php

namespace Modules\HelpDesk\Http\Livewire\Settings;

use Livewire\Component;
use Modules\Helpdesk\Entities\TicketSubCategory;
use Modules\Helpdesk\Entities\TicketCategory;
use Modules\HelpDesk\Entities\TicketPriority;

class FormSubCategory extends Component
{
    public TicketSubCategory $editingSubCategory;
    public TicketSubCategory $subCategory;
    public $selectSubCategory = 1;

    public function mount()
    {
       // $this->subCategory = new TicketSubCategory();
    }

    public $rules = [

        'subCategory.name' => 'required | string',
        'subCategory.description' => 'max:100',
        'subCategory.ticket_category_id' => 'required',
        'editingSubCategory.id' => 'integer',
        'editingSubCategory.name' => 'required | string',
        'editingSubCategory.description' => 'max:100',
        'editingSubCategory.ticket_category_id' => 'required',

    ];

    public function save()
    {
        //dd($this->subCategory);
        //$this->validate();
        $this->subCategory->save();
        return redirect()->to('/helpdesk/configuracoes/sub-categorias')->with('message', 'Sub-Categoria criada com sucesso!');
    }

    public function update()
    {
        //$this->validate();
        $this->editingSubCategory->save();
        return redirect()->to('/helpdesk/configuracoes/sub-categorias')->with('update_message', 'Sub-Categoria atualizada com sucesso!');
    }


    public function render()
    {
        //$this->editingSubCategory = TicketSubCategory::find($this->selectSubCategory);
        return view('helpdesk::livewire.settings.form-sub-category', [
            'categories' => TicketCategory::orderBy('order')->get(),
        'subcategories' => TicketSubCategory::paginate(10)]);
    }
}
