<?php

namespace App\Http\Livewire\Users\Permissions;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class ShowUserPermissions extends Component
{
    public User $user;
    public $modalDetails = false;
    public $modalPermissions = false;
    public $showing_role;
    public $role_permissions;

    public $listeners = [
        'refreshPermissions' => '$refresh'
    ];

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function showDetails($role_name)
    {
        $this->showing_role = Role::findByName($role_name);
        $this->role_permissions = $this->showing_role->permissions()->get();
        $this->modalDetails = true;
    }

    public function showDirectPermissions()
    {
        $this->modalPermissions = true;
    }

    public function revokeRole($role_name)
    {
        if ($this->user->removeRole($role_name)) {
            $this->dispatchBrowserEvent(
                'notify',
                ['type' => 'success', 'message' => 'Cargo removido com sucesso!']
            );
        } else {
            $this->dispatchBrowserEvent(
                'notify',
                ['type' => 'error', 'message' => 'Ocorreu um erro ao remover.']
            );
        }
    }

    public function revokePermission($permission_name)
    {
        if ($this->user->revokePermissionTo($permission_name)) {
            $this->dispatchBrowserEvent(
                'notify',
                ['type' => 'success', 'message' => 'Permissão removida com sucesso!']
            );
        } else {
            $this->dispatchBrowserEvent(
                'notify',
                ['type' => 'error', 'message' => 'Ocorreu um erro ao remover.']
            );
        }

    }

    public function render()
    {
        return view('livewire.users.permissions.show-user-permissions');
    }
}
