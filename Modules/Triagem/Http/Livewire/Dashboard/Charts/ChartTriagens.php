<?php

namespace Modules\Triagem\Http\Livewire\Dashboard\Charts;

use Livewire\Component;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;
use Asantibanez\LivewireCharts\Models\RadarChartModel;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Modules\Triagem\Entities\Term;

class ChartTriagens extends Component
{
    public $firstRun = true;

    public function render()
    {
        $rm_hoje = Term::whereDate('created_at', today())->where('sector_id', 1)->count();
        $rm_ontem = Term::whereDate('created_at', today()->subDays(1))->where('sector_id', 1)->count();
        $rm_2_dias = Term::whereDate('created_at', today()->subDays(2))->where('sector_id', 1)->count();
        $rm_3_dias = Term::whereDate('created_at', today()->subDays(3))->where('sector_id', 1)->count();
        $rm_4_dias = Term::whereDate('created_at', today()->subDays(4))->where('sector_id', 1)->count();

        $lineChartRM =
            (new ColumnChartModel())
            ->setAnimated($this->firstRun)
            ->setSmoothCurve()
            ->setTitle('Triagens de Ressonância por dia')
            ->addColumn(today()->subDays(4)->format('d/m/y'), $rm_4_dias, '#808080')
            ->addColumn(today()->subDays(3)->format('d/m/y'), $rm_3_dias, '#90ee90')
            ->addColumn(today()->subDays(2)->format('d/m/y'), $rm_2_dias, '#f6ad55')
            ->addColumn('Ontem', $rm_ontem, '#fc8181')
            ->addColumn('Hoje', $rm_hoje, '#90cdf4');

        $this->firstRun = false;

        return view('triagem::livewire.dashboard.charts.chart-triagens')
            ->with(['lineChartRM' => $lineChartRM]);
    }
}
