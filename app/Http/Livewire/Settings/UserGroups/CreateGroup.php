<?php

namespace App\Http\Livewire\Settings\UserGroups;

use Livewire\Component;
use App\Models\UserGroup;

class CreateGroup extends Component
{
    public UserGroup $group;

    protected $rules = [
        'group.name' => 'required'
    ];

    public function save()
    {
        $group = new UserGroup();
    }

    public function render()
    {
        return view('livewire.settings.user-groups.create-group');
    }
}
