<?php

namespace Modules\NC\Http\Livewire\Utils;

use Livewire\Component;
use App\Models\UserGroup;

class DashboardFilter extends Component
{
    public $start_date;
    public $end_date;
    public $modal_filters = false;
    public $selectAllSectors = false;
    public $selected_sectors = [];

    public function refreshChildren()
    {
        $this->emitUp('refreshChildren', $this->start_date, $this->end_date, $this->selected_sectors);
    }

    public function render()
    {
        return view('nc::livewire.utils.dashboard-filter', ['sectors' => UserGroup::all()]);
    }
}
