<?php

namespace Modules\HelpDesk\View\Components;

use Illuminate\View\Component;

class TicketAvatar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $role;
    public $name;
    public $profile_img;
    public function __construct($role, $name, $profile_img)
    {
        $this->role = $role;
        $this->name = $name;
        $this->profile_img = $profile_img;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('helpdesk::components.ticket-avatar');
    }
}
