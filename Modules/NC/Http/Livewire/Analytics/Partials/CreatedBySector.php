<?php

namespace Modules\NC\Http\Livewire\Analytics\Partials;

use App\Models\UserGroup;
use Livewire\Component;
use Modules\NC\Entities\NonConformity;

class CreatedBySector extends Component
{
    public $users = [];
    public $groups;
    public $group_count = [];
    public $group_names = [];
    public $start_date;
    public $end_date;


    protected $listeners = [
        'echo:nc-analytics,NonConformityCreated' => 'refreshMe',
        'refreshChildren' => 'refreshMe'
    ];

    public function getData($start_date, $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->groups = UserGroup::all();

        foreach ($this->groups as $group) {
            $count = NonConformity::join('users', 'users.id', '=', 'non_conformities.source_user_id')
                ->join('user_groups', 'user_groups.id', '=', 'users.user_group_id')
                ->where('user_groups.id', $group->id)
                ->whereBetween('non_conformities.created_at', [$this->start_date, $this->end_date])
                ->count();
            if ($count > 0) {
                $this->group_count[] = $count;
                $this->group_names[] = substr($group->name, 0, 5);
            }
        }
    }
    public function mount($start_date, $end_date)
    {

       $this->getData($start_date, $end_date);

    }

    public function refreshMe()
    {

        foreach ($this->groups as $group) {
            $count = NonConformity::join('users', 'users.id', '=', 'non_conformities.source_user_id')
                ->join('user_groups', 'user_groups.id', '=', 'users.user_group_id')
                ->where('user_groups.id', $group->id)
                ->whereBetween('non_conformities.created_at', [$this->start_date, $this->end_date])
                ->count();
            if ($count > 0) {
                $group_count[] = $count;
                $group_names[] = substr($group->name, 0, 5);
            }
        }
        $group_count = array_replace($this->group_count, $group_count);
        $group_names = array_replace($this->group_names, $group_names);
        $this->emit('refreshChartCBS', ['groupCountCreated' => $group_count, 'groupNamesCreated' => $group_names]);
    }

    public function render()
    {
        return view('nc::livewire.analytics.partials.created-by-sector');
    }
}
