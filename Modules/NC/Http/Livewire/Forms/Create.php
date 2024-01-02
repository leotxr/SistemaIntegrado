<?php

namespace Modules\NC\Http\Livewire\Forms;

use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Modules\NC\Entities\NCClassification;
use Modules\NC\Entities\NCEnvolvedUser;
use Modules\NC\Entities\NCHistory;
use Modules\NC\Entities\NonConformity;

class Create extends Component
{
    public NonConformity $nc;
    public $search_user = '';
    public $selectedUsers = [];
    public $open = false;

    protected $rules = [
        'nc.n_c_date' => 'required',
        'nc.n_c_classification_id' => 'required',
        'nc.description' => 'required',
        'selectedUsers' => 'required'
    ];

    protected $listeners = [
        'openModalCreate'
    ];

    public function openModalCreate()
    {
        $this->resetExcept('nc');
        $this->nc = new NonConformity();
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

        $this->nc->source_user_id = Auth::user()->id;
        $this->nc->n_c_status_id = 1;
        if ($this->nc->save()) {

            foreach ($this->selectedUsers as $selectedUser) {
                $user = User::find($selectedUser);
                $this->nc->targetUsers()->attach($this->nc->id, ['user_id' => $user->id, 'user_group_id' => $user->user_group_id]);
                //$target_user = new NCEnvolvedUser(['user_id' => $user, 'non_conformity_id' => $this->nc->id]);
                //$target_user->save();
            }

            $this->open = false;
            $this->dispatchBrowserEvent(
                'notify',
                ['type' => 'success', 'message' => 'Não Conformidade criada com sucesso!']
            );
            $this->emitUp('refreshParent');
        }
    }

    public function updatedSelectedUsers()
    {
        $this->search_user = '';
    }

    public function removeUser($id)
    {
        $key = array_search($id, $this->selectedUsers);
        unset($this->selectedUsers[$key]);
    }

    public function render()
    {
        return view('nc::livewire.forms.create', [
            'target_users' => User::search('name', $this->search_user)->whereNotIn('id', $this->selectedUsers)->get(),
            'sectors' => UserGroup::all(),
            'classifications' => NCClassification::all()
        ]);
    }
}
