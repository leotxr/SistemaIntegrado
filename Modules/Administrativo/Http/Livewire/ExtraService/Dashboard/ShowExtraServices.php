<?php

namespace Modules\Administrativo\Http\Livewire\ExtraService\Dashboard;

use Livewire\Component;
use Modules\HelpDesk\Entities\ExtraService;
use Modules\HelpDesk\Entities\TicketStatus;

class ShowExtraServices extends Component
{
    public $selected_status = 1;

    protected $listeners = ['refreshParent' => '$refresh'];

    public function render()
    {
        return view('administrativo::livewire.extra-service.dashboard.show-extra-services',
        [
            'statuses' => TicketStatus::whereNot('id', 2)->get(),
            'extra_services' => ExtraService::where('status_id', $this->selected_status)->paginate(10),

        ]);
    }
}
