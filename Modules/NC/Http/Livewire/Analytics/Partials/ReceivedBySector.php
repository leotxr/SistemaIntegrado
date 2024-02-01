<?php

namespace Modules\NC\Http\Livewire\Analytics\Partials;

use App\Models\UserGroup;
use Livewire\Component;

class ReceivedBySector extends Component
{
    public $groups;
    public $group_count = [];
    public $group_names = [];
    public $start_date;
    public $end_date;


    protected $listeners = [
        'echo:nc-analytics,NonConformityCreated' => 'refreshMe',
        'refreshChildren' => 'refreshMe'
    ];

    public function mount($start_date, $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->groups = UserGroup::all();

        foreach ($this->groups as $group) {
            if ($group->groupNonConformities->whereBetween('created_at', [$this->start_date, $this->end_date])->count() > 0) {
                $this->group_count[] = $group->groupNonConformities->whereBetween('created_at', [$this->start_date, $this->end_date])->count();
                $this->group_names[] = $group->name;
            }
        }

    }

    public function refreshMe($start_date, $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;

        $this->groups = UserGroup::all();

        foreach ($this->groups as $group) {
            if ($group->groupNonConformities->whereBetween('created_at', [$this->start_date, $this->end_date])->count() > 0) {
                $group_count[] = $group->groupNonConformities->whereBetween('created_at', [$this->start_date, $this->end_date])->count();
                $group_names[] = $group->name;
            }

        }
        $group_count = array_replace($this->group_count, $group_count);
        $group_names = array_replace($this->group_names, $group_names);


        $this->emit('refreshChartRBS', ['groupCountReceived' => $group_count, 'groupNamesReceived' => $group_names]);
    }

    public function render()
    {
        return view('nc::livewire.analytics.partials.received-by-sector');
    }
}
