<?php

namespace Modules\Gestao\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Badge extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view/contents that represent the component.
     */
    public function render(): View|string
    {
        return view('gestao::components.badge');
    }
}
