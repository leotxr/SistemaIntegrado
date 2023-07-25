<?php

namespace Modules\HelpDesk\Http\Livewire\Components;

use Livewire\Component;

class NotificationDot extends Component
{
    protected $listeners = [
        'echo:dashboard,TicketCreated' => '$refresh',
    ];
    
    public function render()
    {
        return view('helpdesk::livewire.components.notification-dot');
    }
}
