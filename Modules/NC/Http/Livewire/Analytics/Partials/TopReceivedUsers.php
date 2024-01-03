<?php

namespace Modules\NC\Http\Livewire\Analytics\Partials;

use Illuminate\Support\Collection;
use Livewire\Component;
use App\Models\User;

class TopReceivedUsers extends Component
{
    public $users;
    public Collection $user_count;

    public function mount()
    {
        $this->users = User::all();
        $this->user_count = collect();

        foreach ($this->users as $user) {
            if ($user->nonConformities->count() > 0) {
                $this->user_count[] = collect(['name' => $user->name, 'value' => $user->nonConformities->count()]);
            }
        }

    }

    public function render()
    {
        return view('nc::livewire.analytics.partials.top-received-users');
    }
}
