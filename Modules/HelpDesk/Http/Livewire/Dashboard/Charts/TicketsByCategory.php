<?php

namespace Modules\HelpDesk\Http\Livewire\Dashboard\Charts;

use Livewire\Component;
use Modules\HelpDesk\Entities\TicketCategory;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;
use Modules\HelpDesk\Entities\Ticket;

class TicketsByCategory extends Component
{
    public $firstRun = true;
    public $showDataLabels = false;
    
    public function render()
    {
        $categories = TicketCategory::all();

        $TicketCategorias = LivewireCharts::ColumnChartModel()
        ->setAnimated($this->firstRun)
        ->setLegendVisibility(false)
        ->withDataLabels(true)
        ->setColors(['#0080ff', '#288bed', '#8abef2', '#1863f0', '#78a3f5']);

        foreach($categories as $category)
        {
            $ChartCategorias = $TicketCategorias
            ->addColumn($category->name, Ticket::
            where('category_id', $category->id)
            ->whereMonth('tickets.created_at', date('m'))
            ->count(), 
            '#b0aeae');
        }

        return view('helpdesk::livewire.dashboard.charts.tickets-by-category', ['TicketsPorCategoria' => $ChartCategorias]);
    }
}
