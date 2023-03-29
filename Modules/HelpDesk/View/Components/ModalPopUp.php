<?php

namespace Modules\HelpDesk\View\Components;

use Illuminate\View\Component;

class ModalPopUp extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $description;
    public $ticket;
    public function __construct($description, $ticket)
    {
        $this->description = $description;
        $this->ticket = $ticket;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('helpdesk::components.modal-pop-up');
    }
}
