<?php

namespace Modules\NC\Http\Livewire\Forms;

use Livewire\Component;
use Modules\NC\Entities\NCHistory;
use Modules\NC\Entities\NonConformity;

class ShowHistory extends Component
{
    public NonConformity $nc;
    public $changes;
    public $open = false;

    protected $listeners = [
      'openModalHistory' => 'show'
    ];

    public function show(NonConformity $nc)
    {
        $this->nc = $nc;
        $this->changes = NCHistory::where('non_conformity_id', $this->nc->id)->get();
        $this->open = true;
    }

    public function render()
    {
        return view('nc::livewire.forms.show-history');
    }
}
