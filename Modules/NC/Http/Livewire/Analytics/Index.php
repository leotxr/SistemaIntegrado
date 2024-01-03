<?php

namespace Modules\NC\Http\Livewire\Analytics;

use App\Models\UserGroup;
use Livewire\Component;
use Modules\NC\Entities\NonConformity;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Index extends Component
{

    public $start_date;
    public $end_date;
    public function refreshChildren()
    {
        $this->emit('refreshChildren', $this->start_date, $this->end_date);
    }

    public function mount()
    {
        $this->start_date = date('Y-m-01 00:00:00');
        $this->end_date = date('Y-m-t 23:59:59');
    }

    public function render()
    {
        return view('nc::livewire.analytics.index');
    }
}
