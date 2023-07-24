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
    use WithPagination;

    public $firstRun = true;
    public $showDataLabels = false;
    public $modalChart = false;
    public $tickets;


    protected $listeners = [
        'onPointClick' => 'handleOnPointClick',
        'onColumnClick' => 'handleOnColumnClick',
        'echo:dashboard,TicketCreated' => 'render'
    ];

    public function handleOnPointClick($point)
    {
        $date = $point['title'];
        $date = str_replace('/', '-', $date);
        $this->tickets = Ticket::whereDate('created_at', date('Y-m-d', strtotime($date)))->get();
        $this->modalChart = true;
    }

    public function handleOnColumnClick($column)
    {
        dd($column);
    }

    public function emitTeste()
    {
         
        $this->emitTo('helpdesk::dashboard.ticket-tabs', 'ticketCreated');
    }

    public function render()
    {
        $groups = UserGroup::whereNotNull('description')->get();

        $dias_atras = [today()->subDays(4), today()->subDays(3), today()->subDays(2), today()->subDays(1), today()->subDays(0)];

        $TicketsDia = LivewireCharts::areaChartModel()
            ->setAnimated($this->firstRun)
            ->setLegendVisibility(true)
            ->setColors('#0080ff')
            ->setDataLabelsEnabled($this->showDataLabels)
            ->setXAxisVisible(true)
            ->withDataLabels()
            ->setYAxisVisible(true)
            ->withOnPointClickEvent('onPointClick');

        $TicketsSetor = LivewireCharts::ColumnChartModel()
        ->setAnimated($this->firstRun)
        ->setLegendVisibility(false)
        ->withDataLabels(true)
        ->setColors(['#0080ff', '#288bed', '#8abef2', '#1863f0', '#78a3f5'])
        ->withOnColumnClickEventName('onColumnClick');

        foreach ($dias_atras as $dia) {
            $ChartDias = $TicketsDia->addPoint($dia->format('d/m/Y'), Ticket::whereDate('created_at', $dia)->count(), '#808080');
        }

        foreach($groups as $grupo)
        {
            $ChartSetores = $TicketsSetor
            ->addColumn($grupo->name, Ticket::join('users', 'users.id', '=', 'tickets.requester_id')
            ->join('user_groups', 'user_groups.id', '=', 'users.user_group_id')
            ->where('user_groups.id', $grupo->id)
            ->whereMonth('tickets.created_at', date('m'))
            ->count(), 
            '#b0aeae');
        }

        

        return view('helpdesk::livewire.dashboard.ticket-charts')
        ->with(['TicketsPorDia' => $ChartDias,
        'TicketsPorSetor' => $ChartSetores]);
    }
}
