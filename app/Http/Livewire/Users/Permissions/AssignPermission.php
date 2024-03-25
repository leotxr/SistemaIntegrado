<?php

namespace App\Http\Livewire\Users\Permissions;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class AssignPermission extends Component
{

    public $user;
    public $selected_permission;

    public function mount($user)
    {
        $this->user = $user;
    }

    public function save()
    {
        if ($this->user->givePermissionTo($this->selected_permission)) {
            $this->dispatchBrowserEvent(
                'notify',
                ['type' => 'success', 'message' => 'Permissão concedida ao usuário!']
            );
            $this->emitUp('refreshPermissions');
        } else {
            $this->dispatchBrowserEvent(
                'notify',
                ['type' => 'error', 'message' => 'Ocorreu um erro ao adicionar a permissão.']
            );
        }


    }

    public function render()
    {
        return view('livewire.users.permissions.assign-permission', ['permissions' => Permission::orderBy('name', 'asc')->get()]);
    }
}
