<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\UserGroup;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateUserForm extends Component
{
    public $groups;
    public $permissions;
    public $roles;

    public function mount()
    {
        $this->groups = UserGroup::all();
        $this->permissions = Permission::all();
        $this->roles = Role::all();
    }
    public function render()
    {
        return view('livewire.create-user-form');
    }
}
