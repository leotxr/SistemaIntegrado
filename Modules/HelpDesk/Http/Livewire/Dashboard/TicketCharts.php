<?php

namespace Modules\HelpDesk\Http\Livewire\Dashboard;

use Livewire\Component;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Asantibanez\LivewireCharts\Models\AreaChartModel;
use Modules\HelpDesk\Entities\Ticket;
use Spatie\Permission\Models\Role;
use App\Models\UserGroup;

class TicketCharts extends Component
{
    public $firstRun = true;
    public $showDataLabels = false;

    protected $listeners = [
        'onPointClick' => 'handleOnPointClick',
    ];

    public function handleOnPointClick($point)
    {
        dd($point);
    }

    public function render()
    {
        $groups = UserGroup::whereNotNull('description')->get();

        $dias_atras = [today()->subDays(4), today()->subDays(3), today()->subDays(2), today()->subDays(1), today()->subDays(0)];

        $TicketsDia = LivewireCharts::areaChartModel()
            ->setAnimated($this->firstRun)
            ->setLegendVisibility(false)
            ->setColors('#0080ff')
            ->setDataLabelsEnabled($this->showDataLabels)
            ->setXAxisVisible(true)
            ->setYAxisVisible(true)
            ->withOnPointClickEvent('onAreaPointClick');

        $TicketsSetor = LivewireCharts::ColumnChartModel()
        ->setAnimated($this->firstRun)
        ->setLegendVisibility(false)
        ->withDataLabels(false)
        ->setColors(['#0080ff', '#288bed', '#8abef2', '#1863f0', '#78a3f5']);

        foreach ($dias_atras as $dia) {
            $ChartDias = $TicketsDia->addPoint($dia->format('d/m/y'), Ticket::whereDate('created_at', $dia)->count(), '#808080');
        }

        foreach($groups as $grupo)
        {
            $ChartSetores = $TicketsSetor
            ->addColumn($grupo->name, Ticket::join('users', 'users.id', '=', 'tickets.requester_id')
            ->join('user_groups', 'user_groups.id', '=', 'users.user_group_id')
            ->where('user_groups.id', $grupo->id)
            ->whereMonth('tickets.created_at', date('m'))
            ->count(), 
            '#808080');
        }

        

        return view('helpdesk::livewire.dashboard.ticket-charts')
        ->with(['TicketsPorDia' => $ChartDias,
        'TicketsPorSetor' => $ChartSetores]);
    }
}
