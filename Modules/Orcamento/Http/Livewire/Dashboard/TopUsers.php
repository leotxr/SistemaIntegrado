<?php

namespace Modules\Orcamento\Http\Livewire\Dashboard;

use Livewire\Component;
use App\Models\User;

class TopUsers extends Component
{
    public $users;

    public function mount()
    {
        $this->users = User::permission('criar orcamento')->get();
    }

    public function render()
    {
        return view('orcamento::livewire.dashboard.top-users');
    }
}
