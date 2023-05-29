<?php

namespace Modules\Triagem\Http\Livewire\Dashboard\Charts;

use Livewire\Component;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;
use Asantibanez\LivewireCharts\Models\RadarChartModel;
use Asantibanez\LivewireCharts\Models\LineChartModel;
use Modules\Triagem\Entities\Term;

class ChartTriagens extends Component
{
    public $firstRun = true;

    public function render()
    {
        $rm_hoje = Term::whereDate('created_at', today())->count();
        $rm_ontem = Term::whereDate('created_at', today()->subDays(1))->count();
        $rm_2_dias = Term::whereDate('created_at', today()->subDays(2))->count();
        $rm_3_dias = Term::whereDate('created_at', today()->subDays(3))->count();
        $rm_4_dias = Term::whereDate('created_at', today()->subDays(4))->count();

        $lineChartRM =
            (new lineChartModel())
            ->setAnimated($this->firstRun)
            ->setSmoothCurve()
            ->setTitle('Triagens de Ressonância por dia')
            ->addPoint(today()->subDays(4)->format('d/m/y'), $rm_4_dias, '#f6ad55')
            ->addPoint(today()->subDays(3)->format('d/m/y'), $rm_3_dias, '#f6ad55')
            ->addPoint(today()->subDays(2)->format('d/m/y'), $rm_2_dias, '#f6ad55')
            ->addPoint('Ontem', $rm_ontem, '#fc8181')
            ->addPoint('Hoje', $rm_hoje, '#90cdf4');

        $this->firstRun = false;

        return view('triagem::livewire.dashboard.charts.chart-triagens')
            ->with(['lineChartRM' => $lineChartRM]);
    }
}
