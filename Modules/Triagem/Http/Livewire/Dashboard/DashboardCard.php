<?php

namespace Modules\Triagem\Http\Livewire\Dashboard;

use Livewire\Component;
use Modules\Triagem\Entities\Term;

class DashboardCard extends Component
{
    public $sector;
    public $stat;
    public $title;

    public function mount($sector, $title)
    {
        $this->title = $title;
        $this->sector = $sector;
        $this->stat = Term::where('sector_id', $this->sector)->count();
    }
    public function render()
    {
        return view('triagem::livewire.dashboard.dashboard-card', [
            'stat' => Term::where('sector_id', $this->sector)->count()]);
    }
}
