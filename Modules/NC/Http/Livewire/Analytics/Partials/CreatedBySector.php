<?php

namespace Modules\NC\Http\Livewire\Analytics\Partials;

use Livewire\Component;
use App\Models\UserGroup;
use App\Models\User;
use Modules\NC\Entities\NonConformity;

class CreatedBySector extends Component
{
    public $users = [];
    public $groups;
    public $group_count = [];
    public $group_names = [];

    public function mount()
    {

        $this->groups = UserGroup::all();

        foreach ($this->groups as $group) {
            $count = NonConformity::join('users', 'users.id', '=', 'non_conformities.source_user_id')
                ->join('user_groups', 'user_groups.id', '=', 'users.user_group_id')
                ->where('user_groups.id', $group->id)
                ->count();
            if ($count > 0) {
                $this->group_count[] = $count;
                $this->group_names[] = substr($group->name, 0, 5);
            }
        }

    }

    public function render()
    {
        return view('nc::livewire.analytics.partials.created-by-sector');
    }
}
