<?php

namespace Modules\Laudo\Http\Livewire\Analytics;

use Livewire\Component;

class PendingExams extends Component
{
    public $start_date ;
    public $end_date;

    public function mount()
    {
        $this->start_date = date('Y-m-d');
        $this->end_date = date('Y-m-d');
    }

    public function refreshChildren()
    {
        $this->emit('refreshChildren', $this->start_date, $this->end_date);
    }


    public function render()
    {
        return view('laudo::livewire.analytics.pending-exams');
    }
}
