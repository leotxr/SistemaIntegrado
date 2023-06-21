<?php

namespace Modules\HelpDesk\Http\Livewire\Dashboard;

use Livewire\Component;
use Modules\HelpDesk\Entities\TicketCategory;

class Dashboard extends Component
{

    public function render()
    {
        return view('helpdesk::livewire.dashboard.dashboard');
    }
}
