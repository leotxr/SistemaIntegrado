<?php

namespace Modules\NC\Http\Livewire\Analytics;

use App\Models\UserGroup;
use Livewire\Component;
use Modules\NC\Entities\NonConformity;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Index extends Component
{

    public function mount()
    {

    }

    public function render()
    {
        return view('nc::livewire.analytics.index');
    }
}
