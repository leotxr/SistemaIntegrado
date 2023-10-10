<?php

namespace App\Http\Livewire\Settings\UserGroups;

use Livewire\Component;
use App\Models\UserGroup;

class ShowGroups extends Component
{
    public function render()
    {
        return view('livewire.settings.user-groups.show-groups', ['groups' => UserGroup::all()]);
    }
}
