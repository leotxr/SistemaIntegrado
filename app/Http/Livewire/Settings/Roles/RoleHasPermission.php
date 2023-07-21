<?php

namespace App\Http\Livewire\Settings\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
class RoleHasPermission extends Component
{
    public $selectedRole = 1;
    public $selectedPermission;
    public Role $role;
    public Permission $revokingPermission;

    public function save()
    {
        $this->role = Role::find($this->selectedRole);
        $this->role->givePermissionTo([$this->selectedPermission]);
        /*
        $store = DB::table('role_has_permissions')->insert([
            'permission_id' => $this->selectedPermission,
            'role_id' => $this->selectedRole
        ]);
        */

    }

    public function revoke(Permission $permission)
    {
        $this->revokingPermission = $permission;
        $this->role = Role::find($this->selectedRole);
        $this->role->revokePermissionTo([$this->revokingPermission]);
    }

    public function render()
    {
        return view('livewire.settings.roles.role-has-permission', [
            'roles' => Role::all(),
            'permissions' => Permission::all(),
            'rolePermissions' => Role::find($this->selectedRole)
        ]);
    }
}
