<?php

namespace Modules\NC\Http\Livewire\Analytics\Partials;

use App\Models\UserGroup;
use Livewire\Component;

class ReceivedBySector extends Component
{
    public $groups;
    public $group_count = [];
    public $group_names = [];

    public function mount()
    {
        $this->groups = UserGroup::all();

        foreach ($this->groups as $group) {
            if ($group->groupNonConformities->count() > 0) {
                $this->group_count[] = $group->groupNonConformities->count();
                $this->group_names[] = substr($group->name, 0, 5);
            }
        }

    }

    public function render()
    {
        return view('nc::livewire.analytics.partials.received-by-sector');
    }
}
