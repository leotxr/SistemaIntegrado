<?php

namespace Modules\HelpDesk\Http\Livewire\Settings;

use Livewire\Component;
use Modules\Helpdesk\Entities\TicketSubCategory;
use Modules\Helpdesk\Entities\TicketCategory;

class FormSubCategory extends Component
{
    public $rules = [

        'subCategory.name' => 'required | string',
        'subCategory.description' => 'max:100',
        'subCategory.order' => 'integer',
        'editingSubCategory.id' => 'integer',
        'editingSubCategory.name' => 'required | string',
        'editingSubCategory.description' => 'max:100',
        'editingSubCategory.order' => 'integer',

    ];

    public function render()
    {
        $this->editingSubCategory = TicketCategory::find($this->selectCategory);
        return view('helpdesk::livewire.settings.form-sub-category', ['categories' => Ticketcategory::orderBy('order')->get()]);
    }
}
