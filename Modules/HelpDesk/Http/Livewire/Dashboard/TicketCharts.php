<?php

namespace Modules\HelpDesk\Http\Livewire\Dashboard;

use Livewire\Component;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;
use Asantibanez\LivewireCharts\Models\RadarChartModel;
use Asantibanez\LivewireCharts\Models\AreaChartModel;
use Modules\HelpDesk\Entities\Ticket;

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
        $dias_atras = [today()->subDays(4), today()->subDays(3), today()->subDays(2), today()->subDays(1), today()->subDays(0)];

        $TicketsDia = LivewireCharts::areaChartModel()
            ->setTitle('Chamados Abertos por Dia')
            ->setAnimated($this->firstRun)
            ->setLegendVisibility(false)
            ->setColors('#0080ff')
            ->setDataLabelsEnabled($this->showDataLabels)
            ->setXAxisVisible(true)
            ->setYAxisVisible(true)
            ->withOnPointClickEvent('onAreaPointClick');

            foreach($dias_atras as $dia)
            {
                $ChartDias = $TicketsDia->addPoint($dia->format('d/m/y'), Ticket::whereDate('created_at', $dia)->count(), '#808080');
        
            }

        return view('helpdesk::livewire.dashboard.ticket-charts')->with(['TicketsPorDia' => $ChartDias,]);
    }
}
