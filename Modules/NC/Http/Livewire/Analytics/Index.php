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
        if ($this->start_date > $this->end_date) {
            $this->dispatchBrowserEvent(
                'notify',
                ['type' => 'error', 'message' => 'A data inicial não pode ser maior que a data final.']
            );
        } else {
            $this->emit('refreshChildren', $this->start_date, $this->end_date);
        }
    }

    public function mount()
    {
        $this->start_date = date('Y-m-01');
        $this->end_date = date('Y-m-t');
    }

    public function render()
    {
        return view('nc::livewire.analytics.index');
    }
}
