<?php

namespace Modules\HelpDesk\Http\Livewire\Dashboard;

use Livewire\Component;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Asantibanez\LivewireCharts\Models\AreaChartModel;
use Modules\HelpDesk\Entities\Ticket;
use Spatie\Permission\Models\Role;
use App\Models\UserGroup;
use Livewire\WithPagination;

class TicketCharts extends Component
{
    public $days_format;
    public $groups_names;
    public $days_values = [];
    public $groups_values = [];

    protected $listeners = [
        'echo:dashboard,TicketCreated' => 'refreshMe',
        'echo:dashboard,TicketUpdated' => 'refreshMe',
    ];

    public function getData()
    {
        $groups = UserGroup::whereNotNull('description')->get();
        $days = [today()->subDays(4), today()->subDays(3), today()->subDays(2), today()->subDays(1), today()->subDays(0)];
        $this->days_format = [today()->subDays(4)->format('d/m/Y'), today()->subDays(3)->format('d/m/Y'), today()->subDays(2)->format('d/m/Y'), today()->subDays(1)->format('d/m/Y'), today()->subDays(0)->format('d/m/Y')];


        foreach ($days as $day) {
            $this->days_values[] = Ticket::whereDate('created_at', $day)->count();
        }

        foreach ($groups as $group) {
            $this->groups_names[] = $group->name;
            $this->groups_values[] = Ticket::join('users', 'users.id', '=', 'tickets.requester_id')
                ->join('user_groups', 'user_groups.id', '=', 'users.user_group_id')
                ->where('user_groups.id', $group->id)
                ->whereMonth('tickets.created_at', date('m'))
                ->count();
        }
    }

    public function mount()
    {
       $this->getData();
    }

    public function refreshMe()
    {
        $groups = UserGroup::whereNotNull('description')->get();
        $days = [today()->subDays(4), today()->subDays(3), today()->subDays(2), today()->subDays(1), today()->subDays(0)];
        $this->days_format = [today()->subDays(4)->format('d/m/Y'), today()->subDays(3)->format('d/m/Y'), today()->subDays(2)->format('d/m/Y'), today()->subDays(1)->format('d/m/Y'), today()->subDays(0)->format('d/m/Y')];


        foreach ($days as $day) {
            $days_values[] = Ticket::whereDate('created_at', $day)->count();
        }

        foreach ($groups as $group) {
            $groups_names[] = $group->name;
            $groups_values[] = Ticket::join('users', 'users.id', '=', 'tickets.requester_id')
                ->join('user_groups', 'user_groups.id', '=', 'users.user_group_id')
                ->where('user_groups.id', $group->id)
                ->whereMonth('tickets.created_at', date('m'))
                ->count();
        }

        $days_values = array_replace($this->days_values, $days_values);
        $groups_values = array_replace($this->groups_values, $groups_values);
        $this->emit('refreshChart', ['seriesDaysData' => $days_values]);
        $this->emit('refreshChart', ['seriesGroupsData' => $groups_values]);

        
    }


    public function render()
    {
        return view('helpdesk::livewire.dashboard.ticket-charts');
    }
}
