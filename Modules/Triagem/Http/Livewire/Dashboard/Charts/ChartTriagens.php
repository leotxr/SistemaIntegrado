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
    public $rm_values = [];
    public $tc_values = [];
    public $rm_sub_values = [];
    public $days_value = 5;
    public $days_before = [];

    public function mount()
    {
        for($i = 0; $i < $this->days_value; $i++)
        {
            $this->days_before[] = today()->subDays($i)->format('d/m/Y');
            $this->rm_values[] = Term::whereDate('created_at', today()->subDays($i))->where('sector_id', 1)->count();
            $this->rm_sub_values[] = Term::whereDate('created_at', today()->subDays($i))->where('sector_id', 3)->count();
            $this->tc_values[] = Term::whereDate('created_at', today()->subDays($i))->where('sector_id', 2)->count();

        }

    }

    public function refreshMe()
    {

    }

    public function render()
    {
        $dias_atras = [today()->subDays(4), today()->subDays(3), today()->subDays(2), today()->subDays(1), today()->subDays(0)];
        $colors = ['#f6ad55', '#fc8181', '#90cdf4', '#f6ad55', '#fc8181' ];
        //$valores = Term::whereIn('created_at', $dias_atras)->where('sector_id', 1)->get();

        $chartRM = LivewireCharts::columnChartModel()
            ->setTitle('Ressonâncias por dia')
            ->setAnimated($this->firstRun)
            ->setLegendVisibility(false)
            ->withDataLabels(false)
            ->setColors(['#0080ff', '#288bed', '#8abef2', '#1863f0', '#78a3f5']);

        $chartTC = LivewireCharts::columnChartModel()
            ->setTitle('Tomografias por dia')
            ->setAnimated($this->firstRun)
            ->setLegendVisibility(false)
            ->withDataLabels(false)
            ->setColors(['#0080ff', '#288bed', '#8abef2', '#1863f0', '#78a3f5']);

            foreach($dias_atras as $dia)
            {
                $columnChartTC = $chartTC->addColumn($dia->format('d/m/y'), Term::whereDate('created_at', $dia)->where('sector_id', 2)->count(), '#808080');
            }


            $this->firstRun = false;

        return view('triagem::livewire.dashboard.charts.chart-triagens')
            ->with(['rm_values' => $this->rm_values, 'days' => $this->days_before ,  'tc_values' => $this->tc_values, 'rm_sub_values' => $this->rm_sub_values]);
    }
}
