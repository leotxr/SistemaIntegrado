<?php

namespace Modules\NC\Http\Livewire\Forms;

use App\Models\User;
use App\Models\UserGroup;
use Livewire\Component;
use Modules\NC\Entities\NCClassification;
use Modules\NC\Entities\NCHistory;
use Modules\NC\Entities\NonConformity;
use Illuminate\Support\Facades\Auth;

class Edit extends Component
{
    public NonConformity $nc;
    public $search_user = '';
    public $open = false;

    protected $listeners = [
        'openModalEdit' => 'edit'
    ];

    protected $rules = [
        'nc.n_c_date' => 'required',
        'nc.n_c_classification_id' => 'required',
        'nc.description' => 'required'
    ];

    public function edit(NonConformity $nc)
    {
        if (auth()->user()->can('editar ncs') || auth()->user()->can('excluir ncs')) {
            $this->nc = $nc;
            $this->open = true;
        } else {
            $this->dispatchBrowserEvent(
                'notify',
                ['type' => 'error', 'message' => 'Você não tem permissão para alterar. Solicite ao seu Coordenador.']
            );
        }

    }

    public function update()
    {
        $this->validate();
        if ($this->nc->isDirty()) $original = $this->nc->getOriginal();

        if ($this->nc->save()) {

            foreach ($this->nc->getChanges() as $key => $value) {
                $history = new NCHistory(['non_conformity_id' => $this->nc->id, 'changed_field' => $key, 'old_value' => $original[$key], 'new_value' => $value, 'updated_by' => Auth::user()->id]);
                $history->save();
            }

            $this->open = false;
            $this->dispatchBrowserEvent(
                'notify',
                ['type' => 'success', 'message' => 'Não Conformidade alterada com sucesso!']
            );
            $this->emitUp('refreshParent');
        }
    }

    public function render()
    {
        return view('nc::livewire.forms.edit', [
            'target_users' => User::search('name', $this->search_user)->get(),
            'sectors' => UserGroup::all(),
            'classifications' => NCClassification::all()
        ]);
    }

}
