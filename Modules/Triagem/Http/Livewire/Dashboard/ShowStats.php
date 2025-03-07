<?php

namespace Modules\Triagem\Http\Livewire\Dashboard;

use Livewire\Component;
use Modules\Triagem\Entities\Term;

class ShowStats extends Component
{
    public $initial_date;
    public $final_date;

    public function mount()
    {
        $this->initial_date = date('Y-m-d');
        $this->final_date = date('Y-m-d');
    }

    public function render()
    {
        return view('triagem::livewire.dashboard.show-stats',[
            'stat_tc' => Term::where('sector_id', 2)
            ->whereBetween('exam_date', [$this->initial_date, $this->final_date])
            ->count(),
            'stat_rm' => Term::where('sector_id', 1)
            ->whereBetween('exam_date', [$this->initial_date, $this->final_date])
            ->count(),
            'stat_rm_sub' => Term::where('sector_id', 3)
            ->whereBetween('exam_date', [$this->initial_date, $this->final_date])
            ->count()
        ]);
    }
}
