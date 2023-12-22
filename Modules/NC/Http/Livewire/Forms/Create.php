<?php

namespace Modules\NC\Http\Livewire\Forms;

use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Modules\NC\Entities\NCClassification;
use Modules\NC\Entities\NCHistory;
use Modules\NC\Entities\NonConformity;

class Create extends Component
{
    public NonConformity $nc;
    public $search_user = '';
    public $open = false;

    protected $rules = [
        'nc.n_c_date' => 'required',
        'nc.target_user_id' => 'required',
        'nc.n_c_classification_id' => 'required',
        'nc.description' => 'required'
    ];

    protected $listeners = [
        'openModalCreate'
    ];

    public function openModalCreate()
    {
        $this->open = true;
    }

    public function mount()
    {
        $this->search_user = '';
        $this->nc = new NonConformity();
    }

    public function save()
    {
        $this->validate();

        $user = User::find($this->nc->target_user_id);
        $this->nc->n_c_sector_id = $user->user_group_id;
        $this->nc->source_user_id = Auth::user()->id;
        $this->nc->n_c_status_id = 1;
        if($this->nc->save())
        {
            $this->open = false;
            $this->dispatchBrowserEvent(
                'notify',
                ['type' => 'success', 'message' => 'Não Conformidade criada com sucesso!']
            );
            $this->emitUp('refreshParent');
        }
    }

    public function render()
    {
        return view('nc::livewire.forms.create', [
            'target_users' => User::search('name', $this->search_user)->get(),
            'sectors' => UserGroup::all(),
            'classifications' => NCClassification::all()
        ]);
    }
}
